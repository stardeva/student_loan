<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

// if(checkUserLogin() && (isset($_GET['itemId']) && $_GET['itemId'] != '')) {
//   $uId = $_SESSION['uid'];
//   $itemId = $_GET['itemId'];
// } else {
//   header("Location: ../signup.php");
// }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 兑换</title>

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
  <body class="personal-page personal-coin-buy">
    <header class="header">
      <nav class="topnav">
        <a href="./personal_coin_mall.php" class="nav text back left"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">兑换</span>
        <div class="nav right"></div>
      </nav>
    </header>
    <section class="main">
      <form action="../api/actions.php" id="personal_coin_buy" name="personal_coin_buy" method="post">
        <input type="hidden" name="uId" value="<?= $uId ?>" />
        <input type="hidden" name="page" value="personal_coin_buy" />
        <input type="hidden" name="backurl" value="../personal/personal_coin_buy.php" />
        <input type="hidden" name="itemId" value="<?= $itemId ?>" />
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="coin_buy_signee" class="required">收货人</label>
              <div class="input-holder">
                <input type="text" name="name" id="coin_buy_signee" required="true" value="" placeholder="请输入收货人姓名" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="coin_buy_phone" class="required">手机号</label>
              <div class="input-holder">
                <input type="tel" name="phone" id="coin_buy_phone" required="true" value="" placeholder="请输入手机号" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="coin_buy_addr" class="required">收货地址</label>
              <div class="input-holder">
                <input type="text" name="addr" id="coin_buy_addr" required="true" value="" placeholder="请输入收货地址" />
              </div>
            </div>
          </div>
        </div>
        <div class="buttons">
          <input type="submit" class="button" value="提交" id="coin_buy_submit" disabled="disabled" />
        </div>
      </form>
    </section>

    <div class="notification-popup"></div>

    <script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>

    <script type="text/javascript" src="../assets/js/main.js"></script>

    <?php if(isset($_SESSION['flash']) && $_SESSION['flash'] != '') : ?>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.notification-popup').html("<?= $_SESSION['flash'] ?>");
        $('.notification-popup').popup({
          autoopen: true,
          blur: false,
          onopen: function() {
            setTimeout(function() {
              $('.notification-popup').popup('hide');
            }, notifyTime);
          }
        });
      });
    </script>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
  </body>
</html>
