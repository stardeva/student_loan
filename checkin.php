<?php
require_once('api/curl.php');
require_once('api/functions.php');

$is_logged_in = checkUserLogin();

if($is_logged_in) {
  $uId = $_SESSION['uid'];

  foreach($_SESSION['sys_info']->ad->carousel as $item) {
    if(strpos($item->url, 'checkin') !== false) $checkin_bg = $item->picUrl;
  }

  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_SIGN'], array('uId' => $uId));
  $result = json_decode($result);

  if($result->error->errno == 200) {
    unset($result->error);
    $coindata = $result;
  }

} else {
  header("Location: ./signup.php");
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
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="home-checkin-page">
    <input type="hidden" id="uid" value="<?= $uId ?>" />
    <a href="index.php" class="arrow"><img src="./assets/images/reg_black_left_arrow.png" alt="" /></a>
    <div class="checkin-bg">
      <img src="<?= $checkin_bg ?>" class="img-responsive" />
    </div>
    <section class="main">
      <div class="wrapper">
        <?php if($coindata->isSigned == 1) : ?>
          <div class="button btn-signed">今天已签到</div>
        <?php else: ?>
          <div class="button btn-unsigned">
            签到领金币
            <div class="note">
              您已连续签到
              <span class="days"><?= $coindata->days ?></span>天
            </div>
          </div>
        <?php endif; ?>
        <div class="coin-ads">
          <?php for($ad = 1; $ad < 5; $ad ++) : ?>
            <div class="ad">
              <img src="assets/images/sign_day.png" />
              <span class="coin">x<?= $ad ?></span>
              <span class="day"><?= $ad ?>天</span>
            </div>
          <?php endfor; ?>
        </div>
        <div class="desc">
          <div class="title">签到规则及说明</div>
          每日签到获得一枚金币，连续签到获得金币速度提高。<br />金币不能提现，但可以兑换为金币商城里面的商品，我们会不断增加金币商城的商品种类，敬请期待。<br />金币兑换后请保持手机畅通。<br />当年累计金币未使用下一年度自动归零。
        </div>
      </div>
    </section>

    <div class="notification-popup"></div>

    <div class="checkin-success-wrapper hidden">
      <div class="checkin-success">
        <img src="assets/images/sign_success.png" />
        <div class="first">今天签到获得金币<span class="days">0</span>个</div>
        <div class="second">累计获得金币<span class="coins">0</span>个</div>
      </div>
    </div>

    <script type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="assets/js/js.cookie.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.popupoverlay.js"></script>

    <script type="text/javascript" src="assets/js/main.js"></script>
  </body>
</html>
