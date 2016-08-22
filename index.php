<?php
session_start();
require_once('api/curl.php');

if(isset($_COOKIE['uid']) && $_COOKIE['uid'] != '') {
  $uId = $_COOKIE['uid'];
  $login_temp = array(
    'uid' => $uId,
    'deviceId' => '00000000000000008:00:27:44:04:bb323ec7466101f399',
    'deviceOs' => 'Android',
    'deviceType' => 'Google Nexus S - 4.1.1 - API 16 - 480x800',
    'deviceOp' => '4.1.1',
    'version' => '1.0.1',
    'deviceToken' => 'dd'
  );

  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $login_temp);
  $result = json_decode($result);

  if($result->error->errno == '200') {
    $carousel = $result->ad->carousel;
  }

  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_INFO'], array('uId' => $uId));
  $result = json_decode($result);
  if($result->error->errno != '200') {
    
  } else {
    $userAllData = $result;
    unset($userAllData->error);
    $_SESSION['user_all_data'] = $userAllData;
  }
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
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="home-index-page">    
    <header class="header">
      <nav class="topnav">
        <a href="signup.php" class="nav text unregistered">未登录</a>
        <span class="nav text title">学融宝</span>
        <a href="personal/personal_my_messages.html" class="nav link notification text-right"><i class="fa fa-envelope"></i></a>
      </nav>
      <?php if(isset($carousel)): ?>
      <div id="banner_slider">
        <?php foreach($carousel as $item): ?>
          <div class="item">
            <a href="<?= $item->url ?>"><img src="<?= $item->picUrl ?>" class="carousel-image" /></a>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </header>

    <section class="toolbar">
      <a href="borrow" class="tool">
        <img src="assets/images/home_icon_loan.png" alt="借款" />
        <span>借&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;款</span>
      </a>
      <a href="refund" class="tool">
        <img src="assets/images/home_icon_repay.png" alt="还款" />
        <span>还&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;款</span>
      </a>
      <a href="estimate/rate.html" class="tool">
        <img src="assets/images/home_icon_rates.png" alt="费率计算" />
        <span>费&nbsp;率&nbsp;计&nbsp;算</span>
      </a>
      <a href="estimate/user.html" class="tool">
        <img src="assets/images/home_icon_feedback.png" alt="评价" />
        <span>评&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价</span>
      </a>
    </section>

    <a href="credits" class="credit">
      <?php if(isset($userAllData)): ?>
        <img src="assets/images/credit-banner.png" alt="" />
        <span class="credit-number"><?= $userAllData->user->quotaTotal ?></span>
      <?php else: ?>
        <img src="assets/images/credit-default.png" alt="" />
      <?php endif; ?>
    </a>

    <footer class="footer">
      <nav class="bottomnav">
        <a href="#" class="nav">
          <img src="assets/images/footer_icon_home.png" alt="首页" />
          <span>首页</span>
        </a>
        <span class="bar"></span>
        <a href="personal" class="nav">
          <img src="assets/images/footer_icon_personal.png" alt="个人" />
          <span>个人</span>
        </a>
        <span class="bar"></span>
        <a href="more" class="nav">
          <img src="assets/images/footer_icon_more.png" alt="更多" />
          <span>更多</span>
        </a>
        <span class="bar"></span>
        <a href="personal/personal_my_history.html" class="nav">
          <img src="assets/images/footer_icon_activity.png" alt="活动" />
          <span>活动</span>
        </a>
      </nav>
    </footer>

    <script type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="assets/js/js.cookie.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/bootbox.min.js"></script>
    <script type="text/javascript" src="assets/js/slick.min.js"></script>
    <script type="text/javascript" src="assets/js/api.js"></script>

    <script type="text/javascript" src="assets/js/main.js"></script>
  </body>
</html>
