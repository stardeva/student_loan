<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

$result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $USER_TEMP);
$result = json_decode($result);

if($result->error->errno == '200') {
  unset($result->error);
  $_SESSION['sys_info'] = $result;
}

$contact = $_SESSION['sys_info']->contact;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 联系客服</title>

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
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">联系客服</span>
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
          <div class="item-desc"><?= $contact->weixin ?></div>
        </div>

        <div class="info-item flex-wrap-space">
          <div class="flex-wrap-space">
            <div class="item-icon"><img src="../assets/images/about_qq.png" /></div>
            <div class="item-title">QQ</div>
          </div>
          <div class="item-desc"><?= $contact->qq ?></div>
        </div>

        <div class="info-item flex-wrap-space">
          <div class="flex-wrap-space">
            <div class="item-icon"><img src="../assets/images/about_tele.png" /></div>
            <div class="item-title">电话</div>
          </div>
          <a href="tel:<?= $contact->tele ?>" class="item-desc"><?= $contact->tele ?></a>
        </div>
      </div>
    </section>

    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>