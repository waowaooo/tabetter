
<?php

$dsn  = 'mysql:dbname=tabetterdb;host=localhost;charset=utf8';
$user = 'webuser';
$pw   = 'abccsd2';
$driver_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];

//データベースに接続
$pdo = new PDO(
     $dsn,
     $user,
     $pw,
     $driver_options
);

$sql = '
    INSERT INTO
        `post_images` (post_id, post_image)
    VALUES
        (:post_id, :post_image)
';

// 画像データ
$img_data = file_get_contents($_FILES['image']['tmp_name']);

// DBに保存
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':post_id', 2);
$stmt->bindValue(':post_image', $img_data);
$stmt->execute();

?>