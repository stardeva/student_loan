<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $userAllData = $_SESSION['user_all_data'];
  $uId = $_SESSION['uid'];
} else {
  header("Location: ../signup.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 个人中心 - 个人资料</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="personal-page personal-my-info">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">个人资料</span>
        <a href="" class="nav text next">完成</a>
      </nav>
    </header>
    <section class="main no-padding">
      <div class="personal-info-list">
        <div class="info-item user-photo right-arrow">
          <div class="item-title">头像</div>
          <div class="user-photo-upload">
            <img src="<?php echo isset($userAllData->user->portrait) && $userAllData->user->portrait != '' ? $userAllData->user->portrait : '../assets/images/user_head.png'; ?>" class="user-photo-preview" />
            <input type="file" id="my_photo" accept='image/*' class="file-upload" />
            <input type="hidden" name="uId" value="<?= $uId ?>" id="uid" />
          </div>
        </div>
        <div class="info-item">
          <div class="item-title">姓名</div>
          <div class="item-desc"><?= $userAllData->user->name ?></div>
        </div>
        <div class="info-item">
          <div class="item-title">学号</div>
          <div class="item-desc">18640329750</div>
        </div>
        <div class="info-item">
          <div class="item-title">额度</div>
          <div class="item-desc"><?= $userAllData->user->quota ?> 元</div>
        </div>
        <div class="info-item">
          <div class="item-title">信用豆</div>
          <div class="item-desc user-credit-beans"><?= $userAllData->user->beans ?></div>
        </div>
        <div class="info-item">
          <div class="item-title">总额度</div>
          <div class="item-desc"><?= $userAllData->user->quotaTotal ?> 元</div>
        </div>
        <br />
        <br />
        <a href="#" class="button">
          退出当前账号
        </a>
      </div>
    </section>
    <footer class="footer">
      <nav class="bottomnav">
        <a href="../" class="nav">
          <img src="../assets/images/footer_icon_home.png" alt="首页" />
          <span>首页</span>
        </a>
        <span class="bar"></span>
        <a href="index.html" class="nav">
          <img src="../assets/images/footer_icon_personal.png" alt="个人" />
          <span>个人</span>
        </a>
        <span class="bar"></span>
        <a href="../more" class="nav">
          <img src="../assets/images/footer_icon_more.png" alt="更多" />
          <span>更多</span>
        </a>
        <span class="bar"></span>
        <a href="../personal/personal_my_history.html" class="nav">
          <img src="../assets/images/footer_icon_activity.png" alt="活动" />
          <span>活动</span>
        </a>
      </nav>
    </footer>

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../assets/js/api.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
