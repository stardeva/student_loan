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
  <body class="personal-page personal-bind-card">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">绑定银行卡</span>
        <div class="nav"></div>
      </nav>
    </header>
    <section class="main">
      <div class="info-box">
        注：请绑定本人的银行卡
      </div>
      <form action="" id="personal_bind_card" name="personal_bind_card" method="post">
        <input type="hidden" name="uId" id="uid" value="<?= $uId ?>" />
        <input type="hidden" name="page" id="page" value="personal_bind_card" />
        <input type="hidden" name="backurl" id="backurl" value="../personal" />
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="personal_bank_card" class="required">银行卡号</label>
              <div class="input-holder">
                <input type="number" name="bankCard" id="personal_bank_card" required="true" placeholder="仅支持储蓄卡" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="select-block">
              <label for="personal_bank_name" class="required">银行</label>
              <div class="input-holder">
                <select name="bank" id="personal_bank_name" required="true">
                  <option selected="selected" disabled="disabled">请选择</option>
                  <?php foreach($BANK_LIST as $bank): ?>
                    <option value="<?= $bank ?>"><?= $bank ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="personal_bank_branch" class="required">开户行</label>
              <div class="input-holder">
                <input type="text" name="bankBranch" id="personal_bank_branch" required="true" placeholder="例如xx支行" />
              </div>
            </div>
          </div>
        </div>
        <div class="buttons">
          <input type="submit" class="button" value="确定" id="bind_bank_submit" disabled="disabled" />
        </div>
      </form>
    </section>

    <div class="notification-popup"></div>

    <script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>

    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>