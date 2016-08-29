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

</head>
<body class="set-estimate-page personal-page">
  <header class="header">
	<nav class="topnav">
	  <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
	  <span class="nav text title">发布评价</span>
	  <div class="nav"></div>
	</nav>
  </header>

  <section class="main-section flex-wrap-column">
  	<form method="post" class="estimate-form loan-form">
  	  <input type="hidden" name="lnId" value="<?= $uId ?>">
  	  <input type="hidden" name="page" value="set_estimate_page">
      <div class="form-group form-row">
        <div class="form-element width-100pc">
          <div class="textarea-holder">
            <textarea rows="10" name="content" id="content" placeholder="请写下对产品的感受吧，对他人帮助很大哦。"></textarea>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="flex-wrap-space space estimate-mark"">
          <div>
	      	评分
	      </div>

      	  <div class="rating">
            <input id="star5" name="star" type="radio" value="5" class="radio-btn " />
            <label for="star5"><div class="star-image image"></div></label>
            <input id="star4" name="star" type="radio" value="4" class="radio-btn " />
            <label for="star4"><div class="star-image image"></div></label>
            <input id="star3" name="star" type="radio" value="3" class="radio-btn " />
            <label for="star3"><div class="star-image image"></div></label>
            <input id="star2" name="star" type="radio" value="2" class="radio-btn " />
            <label for="star2"><div class="star-image image"></div></label>
            <input id="star1" name="star" type="radio" value="1" class="radio-btn " />
            <label for="star1"><div class="star-image image"></div></label>
            <div class="clearfix"></div>
          </div>
        </div>
      	
      </div>

      <div class="form-group has-success flex-wrap-space submit-group">
      	<div>
      		<div class="agree-checkbox">
              <input type="checkbox" name="agree" id="agree" checked="true" />
              <label class="checkbox-label" for="agree">
                <b>匿名评论</b>
              </label>
            </div>  
      	</div>

      	<div>
      	  <input type="submit" class="btn submit-btn has-success" value="发布评价" id="feedback_submit" disabled="disabled" onclick="giveUserFeedback(event)"  />	
      	</div>
      </div>
    </form>
  </section>

  <script src="../assets/js/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/js.cookie.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/bootbox.min.js"></script>
  <script src="../assets/js/bootstrapValidator.min.js"></script>
  <script src="../assets/js/main.js"></script>

</body>
</html>