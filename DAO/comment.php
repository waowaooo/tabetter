<?php
$pdo = new PDO('mysql:host=localhost; dbname=tabetterdb; charset=utf8',
'webuser', 'abccsd2');



if(isset($_POST['comment_detail']) && $_POST['comment_detail'] !== ''){


// 投稿に対してのコメントができる機能

$sql = "INSERT INTO post_comment(comment_detail,comment_date, user_id, post_id)
VALUES(?,CURRENT_TIMESTAMP,?,1)";
$ps = $pdo->prepare($sql);
$ps -> bindValue(1,$_POST['comment_detail'],PDO::PARAM_STR);
$ps -> bindValue(2,$_POST['user_id'],PDO::PARAM_STR);
$ps->execute();



header('Location: https://localhost/tabetter/html/T.syosai2.php');
}else{
    header('Location: https://localhost/tabetter/html/commentcheck.php');
}

?>