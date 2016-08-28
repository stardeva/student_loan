<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

$user_temp = array(
  'deviceId' => '00000000000000008:00:27:44:04:bb323ec7466101f399',
  'deviceOs' => 'Android',
  'version' => '1.0.1'
);

$result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $user_temp);
$result = json_decode($result);

if($result->error->errno == '200') {
  unset($result->error);
  $_SESSION['sys_info'] = $result;
}

if(isset($_SESSION['sys_info']))
  $carousel = $_SESSION['sys_info']->ad->carousel;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 活动</title>

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
  <body class="personal-page personal-activity-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">活动</span>
        <div class="nav"></div>
      </nav>
    </header>
    <section class="main no-padding">
      <div class="activity-block">
        <?php foreach($carousel as $item): ?>
          <a href="<?= $item->url ?>" class="activity"><img src="<?= $item->picUrl ?>" class="img-responsive" /></a>
        <?php endforeach; ?>
      </div>
    </section>

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
