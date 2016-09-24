<?php
require_once('api/curl.php');
require_once('api/functions.php');

$result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $USER_TEMP);
$result = json_decode($result);

if($result->error->errno == '200') {
  unset($result->error);
  $_SESSION['sys_info'] = $result;
  $contract = $_SESSION['sys_info']->contract;
}

if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'file_view.php') === false) {
  $_SESSION['login_url'] = $_SERVER['HTTP_REFERER'];
}
if(!isset($_SESSION['login_url'])) {
  $backurl = 'index.php';
  $backurl_post = '../index.php';
} else {
  $backurl = $_SESSION['login_url'];
  $backurl_post = $backurl;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 登录</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="signup-page">
    <header class="header">
      <nav class="topnav">
        <a href="<?= isset($backurl) ? $backurl : './' ?>" class="nav text back left"><img src="./assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">登录</span>
        <div class="nav right"></div>
      </nav>
    </header>

    <section class="main">
      <form method="POST" action="api/actions.php">
        <input type="hidden" name="phone" value="15640111949" />
        <input type="hidden" name="passwd" value="7018e9bbe25b6617aabebd1d789d36b7" />
        <input type="hidden" name="page" value="signup_page" />
        <input type="hidden" name="backurl" value="<?= isset($backurl_post) ? $backurl_post : '' ?>" />
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="signup_student_id">学&nbsp;&nbsp;&nbsp;号:</label>
              <div class="input-holder">
                <input type="text" name="signup_student_id" id="signup_student_id" required="true" placeholder="请输入智慧大学学号" />
              </div>
            </div>
          </div>
        </div>
        <div class="checkbox" id="signup_checkbox">
          <div class="check-tick checked"></div>
          <input type="checkbox" name="signgup_agree" id="signup_agree" class="hidden" checked="checked" />
          <label for="signup_agree"> 我己阅读开同意 <a href="./file_view.php?fileurl=<?= $contract->privacy ?>&title=隐私条款" class="link">《隐私条款》</a>及 <a href="./file_view.php?fileurl=<?= $contract->reg ?>&title=授权协议" class="link">《授权协议》</a>.</label>
        </div>
        <div class="buttons">
          <input type="submit" class="button" value="登录" id="signup_submit" disabled="disabled" />
        </div>
      </form>
      <img src="./assets/images/login.png" class="img-responsive width-100pc" />
    </section>

    
    <footer class="footer">
      <nav class="bottomnav">
        <a href="index.html" class="nav">
          <img src="assets/images/footer_icon_home.png" alt="首页" />
          <span>首页</span>
        </a>
        <a href="personal" class="nav">
          <img src="assets/images/footer_icon_personal.png" alt="个人" />
          <span>个人</span>
        </a>
        <a href="more" class="nav">
          <img src="assets/images/footer_icon_more.png" alt="更多" />
          <span>更多</span>
        </a>
        <a href="personal/personal_activities.php" class="nav">
          <img src="assets/images/footer_icon_activity.png" alt="活动" />
          <span>活动</span>
        </a>
      </nav>
    </footer>

    <div class="notification-popup"></div>

    <script type="text/javascript" src="assets/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="assets/js/js.cookie.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.popupoverlay.js"></script>

    <script src="assets/js/main.js"></script>

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
