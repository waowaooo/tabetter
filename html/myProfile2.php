<?php 
    session_start();
    require_once '../DAO/userdb.php';
    $userdao = new DAO_userdb();
    require_once '../DAO/rank.php';
    $rank = new DAO_rank();
    
   
    //データベースに接続
    $pdo = new PDO('mysql:host=localhost; dbname=tabetterdb; charset=utf8',
    'webuser', 'abccsd2');

    $sql = "SELECT * FROM user_image WHERE user_id = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $_SESSION['user_id'], PDO::PARAM_STR);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    $img = base64_encode($image['user_image']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Bar3.css">
    <link rel="stylesheet" href="../css/profile2.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/scrollable.css">
</head>


<body>

   <!-- ヘッダー -->
   <header class="mb-3 border-bottom" id="header">
    <div class="container-fluid">
        <div class="row row justify-content-between">

            <div class="d-flex align-items-center mb-0 text-dark text-decoration-none col-7 text-left px-0" style="height: 50px; padding-top: 55px;">
                <img src="../svg/a.svg">
            </div>

            <button class="navbar-toggler col-3 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation" style="height: 50px; box-shadow: none;">
                <img src="../svg/b.svg">       
            </button>

        </div>
        <div class="collapse navbar-collapse" id="navbarsExample05">
            <form wtx-context="0C9FB6AB-0B58-4B25-A43A-44B7ADC851E5" class="mx-4">
              <input class="form-control text-center mb-3" type="text" placeholder="キーワードを入力" aria-label="Search" wtx-context="AA84657A-0F9B-4A04-B5FA-D24659B477FD"
              style="height: 34px;
              border: 3px solid #FFAC4A; 
              box-shadow: none;">
            </form>
        </div>
    </div>
  </header>
  
  <!-- ヘッダー↑ -->
  <div class="scrollable">
  <div style="height: 800px;">
  <div id="app">
    <div class="profile_icon">
    <button v-on:click="openModal" class="photo-button">
    <!--画像 -->
    <div class="icon-image">
            <img src="data:<?php echo $image['image_type'] ?>;base64,<?php echo $img; ?>">
    </div>
    </button>
    </div>
    <!-- open-modalの中身が表示される -->
    <open-modal v-show="showContent" v-on:from-child="closeModal">
        <form method="POST" action="../DAO/newuserimagedb.php" enctype="multipart/form-data">
                <div>
                <input type="file" name="image">
                <input type="hidden" name="id" value="<?= $_SESSION['user_id']?>">
                <input type="submit" value="送信！">
            </div>
        </form>
    </open-modal>

    </div>


    <div class="edit">
    
        <img src="../svg/tpyosaka.svg" alt="編集ボタン" onclick="openModal()">

</div>
    <div class="account">
        <h1 class="name" id="username"><?= $userdao->getUserName($_SESSION['user_id']); ?></h1>
    </div>
    <div>
        <p class="name_id"><?= $_SESSION['user_id']?></p>
    </div>
    <div class="rank">
        <img src="../svg/trophy.svg" alt="トロフィー" class="trophy">
        <p id="r_name"><?= $rank->userRank($_SESSION['user_id']); ?></p>
    </div>
    <div class="waku">
    <div class="frame">
    <p id="bio"><?= $userdao->getUserBio($_SESSION['user_id']); ?></p>
    </div>
    </div>
</div>
   <!-- モーダル -->
<!-- <div id="modal" class="modal">
    <div class="modal-content">
    <form method="POST" action="../DAO/userupdate.php" enctype="multipart/form-data">
        <h2>プロフィール編集</h2>
        <label for="edit-username">ユーザー名:</label>
        <input type="text" id="user_name">
        <label for="edit-bio">自己紹介文:</label>
        <textarea id="bio"><?= $userdao->getUserBio($_SESSION['user_id']); ?></textarea>
        <input type="hidden" name="id" value="<?= $_SESSION['user_id']?>">
        <button onclick="saveChanges()" type="submit">保存</button>
        <button onclick="closeModal()">キャンセル</button>
    </form>
    </div>
</div> -->

<div id="modal" class="modal">
    <div id="overlay" class="modal-content">
    <div id="content" class="content">
    <form method="POST" action="../DAO/userupdate.php" enctype="multipart/form-data">
    <h2>プロフィール編集</h2>
        <p>ユーザー名:</p>
        <input type="text" name="user_name" id="edit-username" value="<?= $userdao->getUserName($_SESSION['user_id'])?>">
        <p>自己紹介文:</p>
        <input type="text" name="bio" id="edit-bio" value="<?= $userdao->getUserBio($_SESSION['user_id'])?>">
        <input type="hidden" name="id" value="<?= $_SESSION['user_id']?>">
        <button onclick="saveChanges()" type="submit">保存</button>
    </form>
    <button onclick="closeModal()">キャンセル</button>
    </div>
    </div>
</div>
    <div class="toukou">
        <button class="button">投稿一覧</button>
    </div>

</div>
</div>



 <!-- navigationBar -->
 <div class="border"></div>

<div class="navigation">
    <a class="list-link" href="timeLine2.php">
        <i class="icon">
            <img src="../svg/time.svg" class="image-size">
        </i>
    </a>
    <a class="list-link" href="forum.php">
        <i class="icon">
            <img src="../svg/forum.svg" class="image-size1">
        </i>
    </a>
    <a class="list-link">
        <i class="icon">
            <img src="../svg/post.svg" class="image-size">
        </i>
    </a>
    <a class="list-link" href="myProfile2.php">
        <i class="icon">
            <img src="../svg/profile2.svg" class="image-size">
        </i>
    </a>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <script src="../js/OyamadaBar.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="../js/MaedaTest.js"></script>
    <script src="../js/Oyamadaprofile.js"></script>

</body>
</html>