<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

$result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $USER_TEMP);
$result = json_decode($result);

if($result->error->errno == '200') {
  unset($result->error);
  $_SESSION['sys_info'] = $result;
  $contract = $_SESSION['sys_info']->contract;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 更多</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
    .pdfobject-container { height: 500px;}
    .pdfobject { border: 1px solid #666; }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="more-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back left"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">更多</span>
        <div class="nav right"></div>
      </nav>
    </header>

    <section class="main no-padding">
      <br />
      <div class="personal-info-list">
        <a href="about_us.php" class="info-item right-arrow">
          <div class="item-title">关于我们</div>
        </a>
        <a href="feedback.php" class="info-item right-arrow">
          <div class="item-title">意见反馈</div>
        </a>
        <a href="contact_us.php" class="info-item right-arrow">
          <div class="item-title">联系客服</div>
        </a>
      </div>

      <br />

      <div class="personal-info-list">
        <a href="contract.php" class="info-item right-arrow">
          <div class="item-title">新手指南</div>
        </a>
        <a href="../file_view.php?fileurl=<?= $contract->help ?>&title=使用帮助" class="info-item right-arrow">
          <div class="item-title">使用帮助</div>
        </a>
      </div>
    </section>

    <footer class="footer">
      <nav class="bottomnav">
        <a href="../" class="nav">
          <img src="../assets/images/footer_icon_home.png" alt="首页" />
          <span>首页</span>
        </a>
        <a href="../personal" class="nav">
          <img src="../assets/images/footer_icon_personal.png" alt="个人" />
          <span>个人</span>
        </a>
        <a href="#" class="nav">
          <img src="../assets/images/footer_icon_more.png" alt="更多" />
          <span>更多</span>
        </a>
        <a href="../personal/personal_activities.php" class="nav">
          <img src="../assets/images/footer_icon_activity.png" alt="活动" />
          <span>活动</span>
        </a>
      </nav>
    </footer>

    <script src="../assets/js/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>
</html>