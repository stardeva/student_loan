<?php

require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $uId = $_SESSION['uid'];
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

    <title>学融宝 - 意见反馈</title>

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
  <body class="more-page more-feedback-page">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">意见反馈</span>
        <div class="nav"></div>
      </nav>
    </header>

    <section class="main no-padding">
      <form method="post" class="more-feedback">
        <input type="hidden" name="uId" id="uid" value="<?= $uId ?>" />
        <input type="hidden" name="page" value="more_feedback" />
        <input type="hidden" name="backurl" id="backurl" value="../more" />
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="textarea-holder">
              <textarea rows="10" name="feedback" id="feedback" placeholder="亲，您遇到什么问题啦？或者有什么好的建议给我们吗？欢迎提给我们！"></textarea>
            </div>
          </div>
        </div>

        <div class="buttons">
          <input type="submit" class="button" value="提交反馈" id="feedback_submit" disabled="disabled" />
        </div>
      </form>
    </section>

    <div class="notification-popup"></div>

    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>

    <script src="../assets/js/main.js"></script>
  </body>
</html>