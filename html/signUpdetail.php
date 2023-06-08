<?php 
//新規登録処理
$pdo = new PDO('mysql:host=localhost; dbname=tabetterdb; charset=utf8',
'webuser', 'abccsd2');

//$content = file_get_contents($_FILES['profileimage']['tmp_name']);
//$image = "../svg/plofile2.svg"

$sql = "INSERT INTO user(user_id,user_name,mail,password)
        VALUES(?,?,?,?)";
$ps = $pdo->prepare($sql);
$ps -> bindValue(1,$_POST['userId'],PDO::PARAM_STR);
$ps -> bindValue(2,$_POST['userName'],PDO::PARAM_STR);
$ps -> bindValue(3,$_POST['mail'],PDO::PARAM_STR);
$ps -> bindValue(4,password_hash($_POST['password'],PASSWORD_DEFAULT),PDO::PARAM_STR);
//$ps -> bindValue(5,$image,PDO::PARAM_STR);
//SQLの実行
$ps->execute();

header('Location: https://localhost/tabetter/html/M.test.php');


?>