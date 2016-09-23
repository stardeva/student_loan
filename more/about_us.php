<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

$result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $USER_TEMP);
$result = json_decode($result);

if($result->error->errno == '200') {
  unset($result->error);
  $_SESSION['sys_info'] = $result;
}

$company = $_SESSION['sys_info']->contact;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 关于我们</title>

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
  <body class="more-page more-aboutus-page">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back left"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">关于我们</span>
        <div class="nav right"></div>
      </nav>
    </header>

    <section class="main">
      <div class="more-about-page text-center">
        <div class="logo-block">
          <img src="../assets/images/logo.png" class="logo" />
        </div>
        <div class="text-left"><?= nl2br($company->content) ?></div>
        <div class="barcode-block">
          <img src="../assets/images/barcode.png" class="barcode" />
        </div>
        <div>扫描二维码，好友即可下载学融宝</div>
        <div class="copyright"><?= $company->company ?></div>
      </div>
    </section>

    <script src="../assets/js/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <script src="../assets/js/main.js"></script>
  </body>
</html>
