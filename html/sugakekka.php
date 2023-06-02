<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    require_once '../DAO/search.php';
    $kekka = new DAO_searc();
?>
<div>
<?= $kekka->getPostDetail($_POST{'keyword'}); ?>
</div>
</body>
</html>