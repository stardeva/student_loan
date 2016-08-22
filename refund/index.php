<?php
session_start();
require_once('../api/curl.php');

if(isset($_COOKIE['uid']) && $_COOKIE['uid'] != '') {
  $uId = $_COOKIE['uid'];
  $login_temp = array(
    'uid' => $uId
  );

  if(isset($_SESSION["initData"])) {
    $userAllData = $_SESSION["initData"];
  }

  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_RETURN'], $login_temp);
  $result = json_decode($result);

  $output = '<script>console.log('.json_encode($result).')</script>';
  echo $output;

} else {
  header("Location: ../signup.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>学融宝</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-slider.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">还款</span>
        <div class="nav"></div>
      </nav>
    </header>

    <section class="main-loan-area">
      <div class="refund-nav image">
        <div class="nav-area">
          <div class="nav-group bank">
            <div class="nav-image-wrap">
              <div class="image"></div>
            </div>
            <div class="nav-detail">
              <div class="title">
                <b>
                  <?php if(isset($userAllData)): ?>
                    <?= $userAllData->returnWay->bankBranch ?>
                  <?php endif; ?>
                </b></div>
              <div class="content">
                <?php if(isset($userAllData)): ?>
                  <?= $userAllData->returnWay->bankCard ?> 分行
                <?php endif; ?>
              </div>
            </div>  
          </div>

          <div class="nav-group pay">
            <div class="nav-image-wrap">
              <div class="image"></div>
            </div>
            <div class="nav-detail">
              <div class="title"><b>支付宝</b></div>
              <div class="content">
                <?php if(isset($userAllData)): ?>
                  <?= $userAllData->returnWay->aliPay ?>
                <?php endif; ?>
              </div>
            </div>  
          </div>

          <div class="nav-group chat">
            <div class="nav-image-wrap">
              <div class="image"></div>
            </div>
            <div class="nav-detail">
              <div class="title"><b>微信</b></div>
              <div class="content">
                <?php if(isset($userAllData)): ?>
                  <?= $userAllData->returnWay->weixinPay ?>
                <?php endif; ?>
              </div>
            </div>  
          </div>        
        </div>

        <div class="nav-description">
          <p>您可任选上述一种方式进行还款， 请您在还款时备注姓名， 手机号及选择的货款产品。</p>
        </div>
      </div>

      <div class="refund-detail">
        <div class="detail-header flex-wrap-space">
          <div><b>活利货</b></div>
          <div class="">
            <span>计划还款</span>
            <span class="highlight-text"><b>&nbsp;&nbsp;￥ 100</b></span>
          </div>
        </div>

        <div class="detail-slider">
          <input id="detail_slider" data-slider-id='exSlider' type="text" class="span2" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="[50,70]"/>
          <div class="slider-value flex-wrap-space">
            <span>0%</span>
            <span>100%</span>
          </div>
        </div>

        <div class="detail-body">
          <div class="detail-group flex-wrap">
            <div class="title"><b>申请时间</b></div>
            <div class="content">2016-04-24</div>
          </div>

          <div class="detail-group flex-wrap">
            <div class="title"><b>申请金额</b></div>
            <div class="content">￥ 100</div>
          </div>

          <div class="detail-group flex-wrap">
            <div class="title"><b>应还款日</b></div>
            <div class="content">2016-04-25</div>
          </div>

          <div class="detail-group flex-wrap">
            <div class="title"><b>剩余应还</b></div>
            <div class="content">￥ 100</div>
          </div>
        </div>
      </div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap-slider.min.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>
</html>