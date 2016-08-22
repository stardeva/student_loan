<?php
session_start();
require_once('../api/curl.php');

if(isset($_COOKIE['uid']) && $_COOKIE['uid'] != '') {
  if(isset($_SESSION["initData"])) {
    $userAllData = $_SESSION["initData"];
  }

} else {
  header("Location: ../signup.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">更多</span>
        <div class="nav"></div>
      </nav>
    </header>

    <section class="more-area loan-data-area">
      <div class="main-wrap">
        <div class="more-wrap ">
          <a href="about_us.php?title=关于我们" class="data-group flex-wrap-space">
            <div class="title"><b>关于我们</b></div>
            <div class="arrow-right image"></div>
          </a>

          <a  href="feedback.php?title=意见反馈" class="data-group flex-wrap-space">
            <div class="title"><b>意见反馈</b></div>
            <div class="arrow-right image"></div>
          </a>  

          <a href="contact_us.php?title=联系客服" class="data-group flex-wrap-space">
            <div class="title"><b>联系客服</b></div>
            <div class="arrow-right image"></div>
          </a>
        </div>

        <div class="helper">
          <a href="contract.php?url=<?= $userAllData->contract->guide?>&title=新手指南&type=jpg" class="data-group flex-wrap-space">
            <div class="title"><b>新手指南</b></div>
            <div class="arrow-right image"></div>
          </a>
          <a href="contract.php?url=<?= $userAllData->contract->help?>&title=使用帮助&type=pdf" class="data-group flex-wrap-space">
            <div class="title"><b>使用帮助</b></div>
            <div class="arrow-right image"></div>
          </a>
        </div>    
      </div>      
    </section>

    <footer class="footer">
      <nav class="bottomnav">
        <a href="../" class="nav">
          <img src="../assets/images/footer_icon_home.png" alt="首页" />
          <span>首页</span>
        </a>
        <span class="bar"></span>
        <a href="../personal" class="nav">
          <img src="../assets/images/footer_icon_personal.png" alt="个人" />
          <span>个人</span>
        </a>
        <span class="bar"></span>
        <a href="#" class="nav">
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>
</html>