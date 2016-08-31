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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="personal-page calculator-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">费率计算</span>
        <div class="nav"></div>
      </nav>
    </header>
    <section class="process">
      <ul class="nav nav-tabs">
        <li class="flex-wrap-space active"><a data-toggle="tab" href="#fuli">福利货</a></li>
        <li class="flex-wrap-space"><a data-toggle="tab" href="#huoli">活利货</a></li>
        <li class="flex-wrap-space"><a data-toggle="tab" href="#yueli">月利货</a></li>
      </ul>

      <div class="tab-content">
        <div id="fuli" class="tab-pane fade in active">
          <div class="loan-kind image">
            <div class="kind-head flex-wrap">
              <span class="flex1 title">借款金额(元)</span>
              <span class="flex1 title">借款期限(天)</span>
            </div>
            
            <div class="kind-body flex-wrap">
              <div class="flex1">
                <select class="cost-selector form-control" rate="<?php echo $caculator_data->lnProdList->prod[0]->rateFlt ?>">
                  <?php
                    setOption($caculator_data->lnProdList->prod[0]->minMoney, $caculator_data->lnProdList->prod[0]->maxMoney, 50);
                  ?>
                </select>
              </div>

              <div class="flex1">
                <select class="during-selector form-control" rate="<?php echo $caculator_data->lnProdList->prod[0]->rateFlt ?>">
                  <?php
                    setOption($caculator_data->lnProdList->prod[0]->minDay, $caculator_data->lnProdList->prod[0]->maxDay, 1);
                  ?>
                </select>
              </div>          
            </div>
          </div>

          <div class="result">
            <span class="pull-left">计划还款</span>
            <div class="pull-right">
              <span class="loan-price">0</span>
              <span class="loan-time"> /<span class="number"><?php $caculator_data->lnProdList->prod[0]->minDay ?></span>天</span>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="start-loan">
            <div class="description">
              <div class="title">
                <p>产品及借款费用说明</p>          
              </div>

              <div class="content">
                <p>
                  <?php
                    echo $caculator_data->lnProdList->prod[0]->intro;
                  ?>
                </p>
              </div>
            </div>

            <div class="description last-description">
              <div class="title">
                <p>逾期费用说明.</p>          
              </div>

              <div class="content">
                <p>
                  <?php
                    echo $caculator_data->lnProdList->prod[0]->lateIntro;
                  ?>
                </p>
            </div>
            </div>     
          </div>
        </div>

        <div id="huoli" class="tab-pane fade">
          <div class="loan-kind image">
            <div class="kind-head flex-wrap">
              <span class="flex1 title">借款金额(元)</span>
              <span class="flex1 title">借款期限(天)</span>
            </div>
            
            <div class="kind-body flex-wrap">
              <div class="flex1">
                <select class="cost-selector form-control" rate="<?php echo $caculator_data->lnProdList->prod[1]->rateFlt ?>">
                  <?php
                    setOption($caculator_data->lnProdList->prod[1]->minMoney, $caculator_data->lnProdList->prod[1]->maxMoney, 50);
                  ?>
                </select>
              </div>

              <div class="flex1">
                <select class="during-selector form-control" rate="<?php echo $caculator_data->lnProdList->prod[1]->rateFlt ?>">
                  <?php
                    setOption($caculator_data->lnProdList->prod[1]->minDay, $caculator_data->lnProdList->prod[1]->maxDay, 1);
                  ?>
                </select>
              </div>   
            </div>
          </div>

          <div class="result">
            <span class="pull-left">计划还款</span>
            <div class="pull-right">
              <span class="loan-price">0</span>
              <span class="loan-time"> /<span class="number"><?php $caculator_data->lnProdList->prod[1]->minDay ?></span>天</span>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="start-loan">
            <div class="description">
              <div class="title">
                <p>产品及借款费用说明</p>          
              </div>

              <div class="content">
                <p>
                  <?php
                    echo $caculator_data->lnProdList->prod[1]->intro;
                  ?>
                </p>
              </div>
            </div>

            <div class="description last-description">
              <div class="title">
                <p>逾期费用说明</p>          
              </div>

              <div class="content">
                <p>
                  <?php
                    echo $caculator_data->lnProdList->prod[1]->lateIntro;
                  ?>
                </p>
              </div>
            </div>     
          </div>
        </div>

        <div id="yueli" class="tab-pane fade">
          <div class="loan-kind image">
            <div class="kind-head flex-wrap">
              <span class="flex1 title">借款金额(元)</span>
              <span class="flex1 title">借款期限(月)</span>
            </div>
            
            <div class="kind-body flex-wrap">
              <div class="flex1">
                <select class="cost-selector form-control" rate="<?php echo $caculator_data->lnProdList->prod[2]->rateFlt ?>">
                  <?php
                    setOption($caculator_data->lnProdList->prod[2]->minMoney, $caculator_data->lnProdList->prod[2]->maxMoney, 50);
                  ?>
                </select>
              </div>

              <div class="flex1">
                <select class="during-selector form-control" rate="<?php echo $caculator_data->lnProdList->prod[2]->rateFlt ?>">
                  <?php
                    setOption($caculator_data->lnProdList->prod[2]->minMonth, $caculator_data->lnProdList->prod[2]->maxMonth, 1);
                  ?>
                </select>
              </div>          
            </div>
          </div>

          <div class="result">
            <span class="pull-left">计划还款</span>
            <div class="pull-right">
              <span class="loan-price">0</span>
              <span class="loan-time"> /<span class="number"><?php $caculator_data->lnProdList->prod[2]->minMonth ?></span>月</span>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="start-loan">
            <div class="description">
              <div class="title">
                <p>产品及借款费用说明</p>          
              </div>

              <div class="content">
                <p>
                  <?php
                    echo $caculator_data->lnProdList->prod[2]->intro;
                  ?>
                </p>
              </div>
            </div>

            <div class="description last-description">
              <div class="title">
                <p>逾期费用说明</p>          
              </div>

              <div class="content">
                <p>
                  <?php
                    echo $caculator_data->lnProdList->prod[2]->lateIntro;
                  ?>
                </p>
              </div>
            </div>     
          </div>
        </div>        
      </div>
    </section>

    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/js.cookie.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootbox.min.js"></script>
    <script src="../assets/js/jsrender.js"></script>

    <script src="../assets/js/main.js"></script>

  </body>
</html>