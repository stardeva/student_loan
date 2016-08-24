<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $userAllData = $_SESSION['user_all_data'];
  $uId = $_SESSION['uid'];
  $creditPercent = min($userAllData->user->quotaTotal, 5000) * 100 / 5000.0;
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

    <title>学融宝 - 信用额度</title>

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
  <body class="credits-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">信用额度</span>
        <a href="../" class="nav link home text-right"><img src="../assets/images/home_icon_home.png" alt="" /></a>
      </nav>
    </header>
    <section class="main">
      <div class="my-credits">
        <div class="my-credits-label">我的额度</div>
        <div class="my-credits-bar">
          <div class="tooltip top credits-tooltip" role="tooltip" style="left: <?= $creditPercent ?>%;">
            <div class="tooltip-arrow"></div>
            <div class="tooltip-inner"><?= min($userAllData->user->quotaTotal, 5000) ?></div>
          </div>
          <div class="progress credits-progress">
            <div class="progress-bar progress-bar-credit" role="progressbar" aria-valuenow="<?= min($userAllData->user->quotaTotal, 5000) ?>" aria-valuemin="0" aria-valuemax="5000" style="width: <?= $creditPercent ?>%">
            </div>
          </div>
          <div class="pin-bar">
            <div class="pin pin0">0</div>
            <div class="pin pin500">500</div>
            <div class="pin pin1000">1000</div>
            <div class="pin pin3000">3000</div>
            <div class="pin pin5000">5000</div>
          </div>
        </div>
      </div>
      <div class="my-credits-data">
        <div class="msg">完善资料可以作为提升信用额度的依据</div>
        <div class="credits-medals">
          <a href="credit_base.php" class="medal base">
            <img src="../assets/images/<?php echo $userAllData->cdBase->audit != 0 ? 'basic_info.png' : 'basic_info_gray.png'; ?>" class="img-responsive center-block" />
          </a>
          <a href="credit_family.php" class="medal home">
            <img src="../assets/images/<?php echo $userAllData->cdHome->audit != 0 ? 'family_info.png' : 'family_info_gray.png'; ?>" class="img-responsive center-block" />
          </a>
          <a href="credit_contact.php" class="medal contacts">
            <img src="../assets/images/<?php echo $userAllData->cdSchool->audit != 0 ? 'contact_info.png' : 'contact_info_gray.png'; ?>" class="img-responsive center-block" />
          </a>
          <a href="credit_other.php" class="medal consume">
            <img src="../assets/images/<?php echo $userAllData->cdSchool->audit != 0 ? 'other_info.png' : 'other_info_gray.png'; ?>" class="img-responsive center-block" />
          </a>
        </div>
        <div class="credits-heart">
          <?php
            $credits_heart = 'credits_0.png';
            if($userAllData->user->quotaTotal >= 5000)
              $credits_heart = 'credits_5000.png';
            else if($userAllData->user->quotaTotal >= 3000)
              $credits_heart = 'credits_3000.png';
            else if($userAllData->user->quotaTotal >= 1000)
              $credits_heart = 'credits_1000.png';
            else if($userAllData->user->quotaTotal >= 500)
              $credits_heart = 'credits_500.png';
            else
              $credits_heart = 'credits_0.png';
          ?>
          <img src="../assets/images/<?= $credits_heart ?>" />
        </div>
      </div>
    </section>
    <footer class="footer">
      <nav class="bottomnav">
        <a href="../" class="nav">
          <img src="../assets/images/footer_icon_home.png" alt="首页" />
          <span>首页</span>
        </a>
        <span class="bar"></span>
        <a href="../personal" class="nav">
          <img src="../assets/images/footer_icon_personal.png" alt="个人" />
          <span>个人</span>
        </a>
        <span class="bar"></span>
        <a href="../more" class="nav">
          <img src="../assets/images/footer_icon_more.png" alt="更多" />
          <span>更多</span>
        </a>
        <span class="bar"></span>
        <a href="../personal/personal_my_history.html" class="nav">
          <img src="../assets/images/footer_icon_activity.png" alt="活动" />
          <span>活动</span>
        </a>
      </nav>
    </footer>

    <div class="notification-popup"></div>

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../assets/js/js.cookie.js"></script>
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
            }, 1000);
          }
        });
      });
    </script>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
  </body>
</html>
