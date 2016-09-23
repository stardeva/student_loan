<?php
require_once('api/curl.php');
require_once('api/functions.php');

$result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $USER_TEMP);
$result = json_decode($result);

if($result->error->errno == '200') {
  unset($result->error);
  $_SESSION['sys_info'] = $result;
}

if(isset($_SESSION['sys_info']))
  $carousel = $_SESSION['sys_info']->ad->carousel;

if(checkUserLogin()) {
  $uId = $_SESSION['uid'];
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_INFO'], array('uId' => $uId));
  $result = json_decode($result);

  if($result->error->errno == 200) {
    $userAllData = $result;
    unset($userAllData->error);
    $_SESSION['user_all_data'] = $userAllData;
    $_SESSION['uid'] = $uId;
  }

  $userAllData = $_SESSION['user_all_data'];
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
        <?php if(checkUserLogin()): ?>
          <div class="nav left"></div>
        <?php else: ?>
          <a href="signup.php" class="nav text unregistered left">未登录</a>
        <?php endif; ?>
        <span class="nav text title">学融宝</span>
        <a href="personal/personal_my_messages.php" class="nav link notification text-right right">
          <i class="fa fa-envelope"></i>
          <div class="unread-icon"></div>
        </a>
      </nav>
      <?php if(isset($carousel)): ?>
      <div id="banner_slider">
        <?php foreach($carousel as $item): ?>          
          <div class="item">
            <?php
              $itemUrl = $item->url;
              if(strpos($itemUrl, 'checkin') !== false) $itemUrl = 'checkin.php';
              if(strpos($itemUrl, 'luckybag') !== false) $itemUrl = 'more/red_activity.php';
            ?>
            <a href="<?= $itemUrl ?>"><img src="<?= $item->picUrl ?>" class="carousel-image" /></a>
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
      <a href="calculate" class="tool calculate-link">
        <img src="assets/images/home_icon_rates.png" alt="费率计算" />
        <span>费&nbsp;率&nbsp;计&nbsp;算</span>
      </a>
      <a href="estimate/index.php" class="tool">
        <img src="assets/images/home_icon_feedback.png" alt="评价" />
        <span>评&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价</span>
      </a>
    </section>

    <a href="credits" class="credit">
      <?php if(isset($userAllData)): ?>
        <img src="assets/images/credit-banner.png" alt="" />
        <?php
          $paddingLeft = '';
          if(strlen($userAllData->user->quotaTotal) == 1) $paddingLeft = 'padding-left: 22%;';
          else if(strlen($userAllData->user->quotaTotal) == 3) $paddingLeft = 'padding-left: 16%;';
          else $paddingLeft = 'padding-left: 12%;';
        ?>
        <span class="credit-number" style="<?= $paddingLeft ?>"><?= $userAllData->user->quotaTotal ?></span>
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
        <a href="personal" class="nav">
          <img src="assets/images/footer_icon_personal.png" alt="个人" />
          <span>个人</span>
        </a>
        <a href="more" class="nav">
          <img src="assets/images/footer_icon_more.png" alt="更多" />
          <span>更多</span>
        </a>
        <a href="personal/personal_activities.php" class="nav">
          <img src="assets/images/footer_icon_activity.png" alt="活动" />
          <span>活动</span>
        </a>
      </nav>
    </footer>

    <script type="text/javascript" src="assets/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="assets/js/js.cookie.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/bootbox.min.js"></script>
    <script type="text/javascript" src="assets/js/slick.min.js"></script>

    <script type="text/javascript" src="assets/js/main.js"></script>
  </body>
</html>
