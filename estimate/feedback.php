<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $uId = $_SESSION['uid'];
  $lnId = $_GET['lnId'];
} else {
  header("Location: ../signup.php");
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝</title>

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
<body class="set-estimate-page personal-page">
  <header class="header">
    <nav class="topnav">
      <a href="../" class="nav text back left"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
      <span class="nav text title">发布评价</span>
      <div class="nav back right"></div>
    </nav>
  </header>

  <section class="main-section">
    <form method="post" class="estimate-form loan-form">
      <input type="hidden" name="uId" value="<?= $uId ?>">
      <input type="hidden" name="lnId" value="<?= $lnId ?>">
      <input type="hidden" name="page" value="set_estimate_page">
      <div class="form-group form-row">
        <div class="form-element width-100pc">
          <div class="textarea-holder">
            <textarea rows="10" name="content" id="content" placeholder="请写下对产品的感受吧，对他人帮助很大哦。"></textarea>
          </div>
        </div>
      </div>

      <div class="form-group has-success">
        <div class="estimate-mark">
          <div class="title pull-left">评分</div>
          <div class="rating pull-right">
            <input id="star5" name="star" type="radio" value="5" class="radio-btn " />
            <label for="star5" data-star="5" class="star-5"><div class="star-image image"></div></label>
            <input id="star4" name="star" type="radio" value="4" class="radio-btn " />
            <label for="star4" data-star="4" class="star-4"><div class="star-image image"></div></label>
            <input id="star3" name="star" type="radio" value="3" class="radio-btn " />
            <label for="star3" data-star="3" class="star-3"><div class="star-image image"></div></label>
            <input id="star2" name="star" type="radio" value="2" class="radio-btn " />
            <label for="star2" data-star="2" class="star-2"><div class="star-image image"></div></label>
            <input id="star1" name="star" type="radio" value="1" class="radio-btn " />
            <label for="star1" data-star="1" class="star-1"><div class="star-image image"></div></label>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="form-group has-success submit-group">
        <div class="pull-left">
          <div class="agree-checkbox">
              <input type="checkbox" name="hide" id="agree" checked="true" value="1" />
              <label class="checkbox-label" for="agree" style="color: #000;">匿名评论</label>
            </div>  
        </div>

        <div class="pull-right">
          <input type="button" class="btn submit-btn has-success" value="发布评价" id="feedback_submit" disabled="disabled"  /> 
        </div>
        <div class="clearfix"></div>
      </div>
    </form>
  </section>

  <div class="notification-popup"></div>

  <script src="../assets/js/jquery-1.12.4.min.js"></script>
  <script src="../assets/js/js.cookie.js"></script>
  <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/bootbox.min.js"></script>
  <script src="../assets/js/bootstrapValidator.min.js"></script>
  <script src="../assets/js/main.js"></script>

</body>
</html>