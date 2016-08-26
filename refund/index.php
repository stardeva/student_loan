<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $uId = $_SESSION['uid'];
  $postdata = array('uid' => $uId);
  $initData = $_SESSION["sys_info"];
  $returnList = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_RETURN'], array('uId' => $uId));
  $returnList = json_decode($returnList);

  $output = '<script>console.log('.json_encode($returnList).')</script>';
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

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
  <body class="personal-page main-loan-area refund-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">还款</span>
        <div class="nav"></div>
      </nav>
    </header>
    
    <?php if(isset($returnList) && count($returnList->lnList->loan) > 0 ): ?>
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
                  <?php if(isset($initData)): ?>
                    <?= $initData->returnWay->bankBranch ?>
                  <?php endif; ?>
                </b></div>
              <div class="content">
                <?php if(isset($initData)): ?>
                  <?= $initData->returnWay->bankCard ?>&nbsp;<?= $initData->returnWay->bankUser ?>
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
                <?php if(isset($initData)): ?>
                  <?= $initData->returnWay->aliPay ?>
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
                <?php if(isset($initData)): ?>
                  <?= $initData->returnWay->weixinPay ?>
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
        <?php foreach($returnList->lnList->loan as $loan): ?>
          <div class="detail-header flex-wrap-space">
            <div><b><?= $loan->name ?></b></div>
            <div class="">
              <span>计划还款</span>
              <span class="highlight-text"><b>&nbsp;&nbsp;￥ <?= $loan->returnTotal ?></b></span>
            </div>
          </div>

          <div class="slider-wrap">
            <input id="detail_slider" data-slider-id='exSlider' type="text" value="" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="[<?php echo($loan->returnMoney/$loan->returnTotal*10) ?>, 10]" data-slider-enabled = "false"/>
            <div class="slider-value flex-wrap-space">
              <span>0%</span>
              <span>100%</span>
            </div>
          </div>

          <div class="detail-body">
            <div class="detail-group flex-wrap">
              <div class="title"><b>申请时间</b></div>
              <div class="content"><?php echo date('Y-m-d', $loan->lnTime); ?></div>
            </div>

            <div class="detail-group flex-wrap">
              <div class="title"><b>申请金额</b></div>
              <div class="content">￥ <?= $loan->money ?></div>
            </div>

            <div class="detail-group flex-wrap">
              <div class="title"><b>应还款日</b></div>
              <div class="content"><?php echo date('Y-m-d', $loan->returnTime); ?></div>
            </div>

            <div class="detail-group flex-wrap">
              <div class="title"><b>剩余应还</b></div>
              <div class="content">￥ <?= $loan->returnTotal ?></div>
            </div>

            <div class="detail-group flex-wrap">
              <div class="title"><b>每期应还</b></div>
              <div class="content">￥ <?= $loan->returnAver ?></div>
            </div>
          </div>
        <?php endforeach; ?>        
      </div>
    </section>
    <?php else: ?>
      <?php 
        $title = '暂不需要还款';
        include '../templates/error_tpl.php';
      ?>
    <?php endif; ?> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap-slider.min.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>
</html>