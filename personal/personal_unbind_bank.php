<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

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

    <title>学融宝 - 绑定银行卡</title>

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
  <body class="personal-page personal-unbind-card">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back left"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">绑定银行卡</span>
        <div class="nav right"></div>
      </nav>
    </header>
    <section class="main">
      <form action="" id="personal_unbind_card" name="personal_unbind_card" method="post">
        <input type="hidden" name="uId" id="uid" value="<?= $uId ?>" />
        <input type="hidden" name="page" id="page" value="personal_unbind_card" />
        <input type="hidden" name="backurl" id="backurl" value="../personal" />
        <input type="hidden" name="bankcard" id="bankcard" value="<?= $userAllData->user->bankCard ?>" />
        <div class="bank-card">
          <div class="bank-name"><?= $userAllData->user->bank ?></div>
          <div class="bank-save-label">储蓄卡</div>
          <div class="bank-card-num">**** **** **** <?= substr($userAllData->user->bankCard, -4) ?></div>
        </div>
        <div class="buttons">
          <input type="submit" class="button success" value="解除绑定" id="bind_unbank_submit" />
        </div>
      </form>
    </section>

    <div class="notification-popup"></div>

    <script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootbox.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>