<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $uId = $_SESSION['uid'];
  if(isset($_SESSION['user_all_data'])) {
    $result = $_SESSION['user_all_data'];
  } else {
    $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_INFO'], array('uId' => $uId));
    $result = json_decode($result);
    $_SESSION['user_all_data'] = $result;
  }

  $user = $result->user;
  
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
  <body class="one-loan-page red-activity-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">红包</span>
        <div class="nav"></div>
      </nav>
    </header>
    <input type="hidden" name="uid" id="uid" value="<?= $uId ?>" />

    <section class="main-loan-area">
      <div class="wrap image flex-wrap-column red-process">
        <div class="flex-wrap-column">
          <div class="grab-amount">
            <?= $grab->grabMoney ?>元
          </div>

          <div class="free-money-content">
            免息额度
          </div>

          <div class="free-remind-content">
            可在福利贷中使用，赶快试试吧！
          </div> 
        </div>

        <div class="red-btn-area">
          <a href="../" class="red-active-btn image btn"></a>
          <div class="red-unactive-btn">
            <a class="btn" href="../"><span class="flex-wrap-column">已兑换</span></a>
          </div>
        </div>
      </div>

      <div class="wrap flex-wrap-column image red-check" style="background-color: #cf4541;">
        <div class="flex-wrap-column flex-block">
          <div class="user-image"><img src="../assets/images/user_head.png"></div>
          <div class="user-name"><b><?= $user->name ?></b> </div>
          <div class="red-remind-content">学融宝抢红包活动限时开始<br />赶快试试你的手气</div>
          <div></div>
        </div>        

        <div class="red-open-btn image" onclick="redClick()"></div>
        
      </div>    

      <div class="red-section"></div>      
    </section>

    <div class="notification-popup"></div>

    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>