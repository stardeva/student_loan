<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $uId = $_SESSION['uid'];
  $postdata = array('uid' => $uId);
  $initData = $_SESSION["sys_info"];
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_RETURN'], array('uId' => $uId));
  $result = json_decode($result);

  if($result->error->errno == 200) {
    $returnList = $result->lnList->loan;
  }

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
    
    <?php if(isset($returnList) && count($returnList) > 0): ?>
    <section class="main-loan-area">
      <div class="refund-nav image">
        <div class="nav-area">
          <div class="nav-group bank">
            <div class="nav-image-wrap">
              <div class="image"></div>
            </div>
            <div class="nav-detail">
              <div class="title">
                <?php if(isset($initData)): ?>
                  <?= $initData->returnWay->bankBranch ?>
                <?php endif; ?>
              </div>
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
              <div class="title">支付宝</div>
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
              <div class="title">微信</div>
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
        <?php foreach($returnList as $loan): ?>
          <div class="detail-wrap">
            <div class="detail-header flex-wrap-space">
              <div class="title"><?= $loan->name ?></div>
              <div class="">
                <span>计划还款</span>
                <span class="highlight-text"><b>&nbsp;￥ <?= $loan->returnTotal ?></b></span>
              </div>
            </div>

            <div class="slider-wrap">
              <?php if($loan->lnProdId == 3): ?>
                <?php if($loan->returnMonth != 0): ?>
                  <input id="detail_slider" data-slider-id='exSlider' data-slider-value="<?= $loan->returnMonth ?>" type="text" data-slider-ticks="[0, <?= $loan->returnMonth ?>, <?= $loan->month ?>]" data-slider-ticks-snap-bounds="30" data-slider-ticks-labels='["0期", "<?= $loan->returnMonth ?>期", "<?= $loan->month ?>期"]'  data-slider-enabled = "false"/>
                  <div class="slider-label-container">
                    <div class="start-label">0期</div>
                    <div class="value-label" slider-value="<?= $loan->returnMonth/$loan->month*100 ?>%"><?= $loan->returnMonth ?>期</div>
                    <div class="end-label"><?= $loan->month ?>期</div>
                  </div>
                <?php else: ?>
                  <input id="detail_slider" data-slider-id='exSlider' data-slider-value = '0' type="text" data-slider-ticks="[0, <?= $loan->month ?>]" data-slider-ticks-snap-bounds="30" data-slider-ticks-labels='["0期", "<?= $loan->month ?>期"]'  data-slider-enabled = "false"/>
                  <div class="slider-label-container">
                    <div class="start-label">0期</div>
                    <div class="end-label"><?= $loan->month ?>期</div>
                  </div>
                <?php endif; ?> 
                
              <?php else: ?>
                <?php if($loan->returnMoney != 0): ?>
                  <input id="detail_slider" data-slider-id='exSlider' type="text" data-slider-ticks="[0, <?= round($loan->returnMoney/($loan->returnTotal + $loan->returnMoney)*100) ?>, 100]" data-slider-value="<?= round($loan->returnMoney/($loan->returnTotal + $loan->returnMoney)*100) ?>" data-slider-ticks-labels='["0%", "<?= round($loan->returnMoney/($loan->returnTotal + $loan->returnMoney)*100) ?>%", "100%"]' data-slider-enabled = "false"/>
                  <div class="slider-label-container">
                    <div class="start-label">0%</div>
                    <div class="value-label" slider-value="<?= round($loan->returnMoney/($loan->returnTotal + $loan->returnMoney)*100) ?>%"><?= round($loan->returnMoney/($loan->returnTotal + $loan->returnMoney)*100) ?>%</div>
                    <div class="end-label">100%</div>
                  </div>
                <?php else: ?>
                  <input id="detail_slider" data-slider-id='exSlider' type="text" data-slider-value="0" data-slider-ticks="[0,100]" data-slider-ticks-snap-bounds="10" data-slider-ticks-labels='["0%", "100%"]' data-slider-enabled = "false"/>
                  <div class="slider-label-container">
                    <div class="start-label">0%</div>
                    <div class="end-label">100%</div>
                  </div>
                <?php endif; ?>                
              <?php endif; ?>  
            </div>

            <div class="detail-body">
              <div class="detail-group flex-wrap">
                <div class="title">申请时间</div>
                <div class="content"><?php echo date('Y-m-d', $loan->lnTime); ?></div>
              </div>

              <div class="detail-group flex-wrap">
                <div class="title">申请金额</div>
                <div class="content">￥ <?= $loan->money ?></div>
              </div>

              <div class="detail-group flex-wrap">
                <div class="title">应还款日</div>
                <div class="content"><?php echo date('Y-m-d', $loan->returnTime); ?></div>
              </div>

              <div class="detail-group flex-wrap">
                <div class="title">剩余应还</div>
                <div class="content">￥ <?= $loan->returnTotal ?></div>
              </div>
              <?php if($loan->lnProdId == 3): ?>
                <div class="detail-group flex-wrap">
                  <div class="title">每期应还</div>
                  <div class="content">￥ <?= $loan->returnAver ?>/期</div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
    <?php else: ?>
      <?php 
        $title = '暂不需要还款';
        $error_type = 'loan';
        include '../templates/error_tpl.php';
      ?>
    <?php endif; ?> 

    <script src="../assets/js/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap-slider.min.js"></script>

    <script src="../assets/js/main.js"></script>
  </body>
</html>
