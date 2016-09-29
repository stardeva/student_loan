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

    <title>学融宝 - 信用额度 - 家庭资料</title>

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
  <body class="credits-page credit-family-page form-page">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back left"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">家庭资料</span>
        <a href="" class="nav text next right">完成</a>
      </nav>
    </header>
    <section class="main">
      <div class="info-box">
        注： 填写全部必填信息才能点亮图标<br />手机号码我们不会主动拨打， 仅作为紧急联系使用
      </div>
      <form action="../api/actions.php" id="credit_family" name="credit_family" method="post">
        <input type="hidden" name="uId" value="<?= $uId ?>" />
        <input type="hidden" name="page" value="credit_family" />
        <input type="hidden" name="backurl" value="../credits/credit_family.php" />
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_family_father_name" class="required">父亲姓名</label>
              <div class="input-holder">
                <input type="text" name="faName" id="credit_family_father_name" required="true" value="<?= $userAllData->cdHome->faName ?>" placeholder="请输入父亲姓名" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_family_father_mobile" class="required">父亲手机</label>
              <div class="input-holder">
                <input type="tel" name="faPhone" id="credit_family_father_mobile" required="true" class="" value="<?= $userAllData->cdHome->faPhone ?>" placeholder="请输入父亲手机" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_family_mother_name" class="required">母亲姓名</label>
              <div class="input-holder">
                <input type="text" name="moName" id="credit_family_mother_name" required="true" value="<?= $userAllData->cdHome->moName ?>" placeholder="请输入母亲姓名" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_family_mother_mobile" class="required">母亲手机</label>
              <div class="input-holder">
                <input type="tel" name="moPhone" id="credit_family_mother_mobile" required="true" class="" value="<?= $userAllData->cdHome->moPhone ?>" placeholder="请输入母亲手机" />
              </div>
            </div>
          </div>
        </div>
        <img src="../assets/images/family_info_page.png" class="img-responsive width-100pc" />
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
