<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $initData = $_SESSION['initData'];
  $uId = $_SESSION['uid'];

  if( isset($initData) ) {}
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

    <title>学融宝</title>

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
  <body class="personal-page">
    <header class="header">
      <nav class="topnav">
        <a href="index.php" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title"><?php echo $_GET['title'] ?></span>
        <div class="nav"></div>
      </nav>
    </header>

    <section class="contact-us-area">
      <div class="personal-info-list">
        <div class="info-item flex-wrap-space">
          <div class="flex-wrap-space">
            <div class="item-icon"><img src="../assets/images/about_wx.png" /></div>
            <div class="item-title">微信</div>
          </div>
          <div class="item-desc"><?php echo $initData->contact->weixin ?></div>
        </div>

        <div class="info-item flex-wrap-space">
          <div class="flex-wrap-space">
            <div class="item-icon"><img src="../assets/images/about_qq.png" /></div>
            <div class="item-title">QQ</div>
          </div>
          <div class="item-desc"><?php echo $initData->contact->qq ?></div>
        </div>

        <div class="info-item flex-wrap-space">
          <div class="flex-wrap-space">
            <div class="item-icon"><img src="../assets/images/about_tele.png" /></div>
            <div class="item-title">电话</div>
          </div>
          <div class="item-desc"><?php echo $initData->contact->tele ?></div>
        </div>
      </div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/pdf.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>