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

  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_MALL_LIST'], array('uId' => $uId));
  $result = json_decode($result);

  if($result->error->errno == 200) {
    $itemList = $result->itemList->item;
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 金币商城</title>

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
  <body class="personal-page personal-coin-mall">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">金币商城</span>
        <div class="nav"></div>
      </nav>
    </header>
    <section class="main">
      <input type="hidden" name="uId" id="uid" value="<?= $uId ?>" />
      <input type="hidden" name="page" id="page" value="personal_coin_mall" />
      <div class="mall-coin-info">您当前有<span><?= $userAllData->user->coins ?></span>个金币</div>
      <div class="mall-item-list">
        <?php if(isset($itemList) && count($itemList) > 0) : ?>
          <?php foreach($itemList as $item) : ?>
            <div class="mall-item" data-item-id="<?= $item->itemId ?>">
              <div class="item-image">
                <img src="<?= $item->picUrl ?>" />
              </div>
              <div class="item-detail">
                <div class="top">
                  <div class="item-name"><?= $item->name ?></div>
                  <div class="item-content"><?= $item->content ?></div>
                </div>
                <div class="bottom">
                  <div class="item-coin-num"><span><?= $item->coinNum ?></span> 金币</div>
                  <?php
                    if($item->coinNum > $userAllData->user->coins) {
                      $url = "javascript:notificationPopup('.notification-popup', '金币不足');";
                    } else {
                      $url = 'personal_coin_buy.php?itemId='.$item->itemId;
                    }
                  ?>
                  <a href="<?= $url ?>" class="item-buy">立即兑换</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>

    <div class="notification-popup"></div>

    <script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>

    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
