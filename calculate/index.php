<!DOCTYPE html>
<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

function setOption ($min, $max, $step) {
  for ($i = $min; $i <= $max; $i+= $step) {
    if ($i == $min) {
      echo "<option value=\"$i\" selected>$i</option>";
    }
    else {
      echo "<option value=\"$i\">$i</option>";
    }
  }
}

if(isset($_SESSION['ln_calculator'])) {
  $caculator_data = $_SESSION['ln_calculator'];
} else {
  $caculator_data = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_CALCULATOR'], array());
  $caculator_data = json_decode($caculator_data);
  $_SESSION['ln_calculator'] = $caculator_data;
}

?>
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
    <link href="../assets/css/drum.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="personal-page calculator-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back left"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">费率计算</span>
        <div class="nav right"></div>
      </nav>
    </header>
    <section class="process">
      <ul class="row nav nav-tabs" id="calc_tab">
        <?php if($caculator_data->lnProdList->prod[0]->lnProdId == 1): ?>
          <li class="col-xs-4 text-center active"><a data-toggle="tab" href="#fuli">福利贷</a></li>
          <li class="col-xs-4 text-center"><a data-toggle="tab" href="#huoli">活利贷</a></li>
          <li class="col-xs-4 text-center"><a data-toggle="tab" href="#yueli">月利贷</a></li>
        <?php else: ?>
          <li class="col-xs-6 table-cell active text-center"><a data-toggle="tab" href="#huoli">活利贷</a></li>
          <li class="col-xs-6 table-cell text-center"><a data-toggle="tab" href="#yueli">月利贷</a></li>
        <?php endif; ?>                
      </ul>

      <div class="tab-content">
        <?php if(isset($caculator_data->lnProdList->prod)): ?>
          <?php foreach($caculator_data->lnProdList->prod as $key => $item): ?>
            <?php if($key== 0): ?>
              <?php if($item->lnProdId == 1): ?>
                <div id="fuli" class="tab-pane fade in active">
              <?php else: ?>
                <div id="huoli" class="tab-pane fade in active">
              <?php endif; ?>
            <?php else: ?>
              <div id="<?= $array_tab_id[$item->lnProdId-1] ?>" class="tab-pane fade">
            <?php endif; ?>            
          
            <div class="loan-kind image">
              <div class="kind-head">
                <span class="col-xs-6 text-center title">借款金额(元)</span>
                <span class="col-xs-6 text-center title">借款期限(<?= $array_time[$item->lnProdId-1] ?>)</span>
              </div>
              
              <div class="kind-body">
                <div class="col-xs-6">
                  <select class="cost-selector form-control loan-selector" proId="<?= $item->lnProdId ?>" rate="<?= $item->rateFlt ?>">
                    <?php
                      setOption($item->minMoney, $item->maxMoney, 50);
                    ?>
                  </select>
                </div>

                <div class="col-xs-6">
                  <select class="during-selector form-control loan-selector" proId="<?= $item->lnProdId ?>" rate="<?= $item->rateFlt ?>">
                    <?php 
                      if($item->lnProdId == 3) {
                        setOption($item->minMonth, $item->maxMonth, 1);
                      } else {
                        setOption($item->minDay, $item->maxDay, 1);
                      }
                    ?>
                  </select>
                </div>

                <div class="sel-top"></div>
                <div class="sel-btm"></div>        
              </div>
            </div>

            <div class="result">
              <span class="pull-left">计划还款</span>
              <div class="pull-right">
                <span class="loan-price">0</span>
                <span class="loan-time"> /
                <span class="number">
                  <?php 
                    if($item->lnProdId != 3) {
                      echo $item->minDay;
                    }
                  ?>                 
                </span>
                <span><?= $array_time[$item->lnProdId-1] ?></span>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="start-loan">
              <div class="description-group">
                <div class="description">
                  <div class="title">
                    <p>产品及借款费用说明</p>          
                  </div>

                  <div class="content">
                    <p>
                      <?= $item->intro;?>
                    </p>
                  </div>
                </div>

                <div class="description last-description">
                  <div class="title">
                    <p>逾期费用说明</p>          
                  </div>

                  <div class="content">
                    <p>
                      <?= $item->lateIntro; ?>
                    </p>
                  </div>
                </div> 
              </div>                
            </div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>   
      </div>
    </section>

    <script src="../assets/js/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/js.cookie.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootbox.min.js"></script>
    <script src="../assets/js/jsrender.js"></script>
    <script src="../assets/js/hammer.min.js"></script>
    <script src="../assets/js/hammer.fakemultitouch.js"></script>
    <script src="../assets/js/drum.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>
</html>