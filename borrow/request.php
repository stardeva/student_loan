<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $uId = $_SESSION['uid'];
  foreach ($_SESSION['ln_calculator']->lnProdList->prod as $key => $value) {
    if($value->lnProdId == $_POST['pro_id']) {
      $caculator_data = $value;
      break;
    }
  }
  
  $originPrice = $_POST['origin_price'];
  $consultPrice = round($caculator_data->consultRateFlt * $originPrice, 2);
  $boundPrice = round($caculator_data->bondRateFlt * $originPrice, 2);
  $remainPrice = $originPrice - $consultPrice - $boundPrice;
 
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
    <link href="../assets/css/bootstrapValidator.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="request-loan-page">
    <header class="header">
      <nav class="topnav">
        <a href="card.php" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">贷款申请</span>
        <div class="nav"></div>
      </nav>
    </header>

    <section class="main-loan-area">
      <div class="main-wrap">
        <div class="loan-detail image">
          <div class="loan-wrap">
            <div class="detail-row">
              <div class="detail-label">借款金额</div>
              <div class="detail-content">
                <label class="detail-value highlight-text"><?= $originPrice ?></label>
                <label class="detail-unit">元</label>
              </div>
            </div>

            <div class="detail-row">
              <div class="detail-label">借款时间</div>
              <div class="detail-content">
                <label class="detail-value highlight-text"><?= $_POST['time'] ?></label>
                <?php if($_POST['pro_id'] == 3): ?>
                  <label class="detail-unit">月</label>
                <?php else: ?>
                  <label class="detail-unit">天</label>
                <?php endif; ?>
              </div>
            </div>  

            <div class="detail-row">
              <div class="detail-label">咨询服务费</div>
              <div class="detail-content">
                <label class="detail-value highlight-text"><?= $consultPrice ?></label>
                <label class="detail-unit">元</label>
              </div>
            </div>

            <div class="detail-row">
              <div class="detail-label">无逾期保证金</div>
              <div class="detail-content">
                <label class="detail-value highlight-text"><?= $boundPrice ?></label>
                <label class="detail-unit">元</label>
              </div>
            </div>

            <div class="detail-row">
              <div class="detail-label">到账金额</div>
              <div class="detail-content">
                <label class="detail-value highlight-text"><?= $remainPrice ?></label>
                <label class="detail-unit">元</label>
              </div>
            </div>

            <div class="detail-row">
              <div class="detail-label">还款金额</div>
              <div class="detail-content">
                <label class="detail-value highlight-text"><?= $_POST['sum_price'] ?></label>
                <label class="detail-unit">元</label>
              </div>
            </div>
          </div> 
        </div>      

        <form id="request_loan_form" class="form-horizontal loan-form" onsubmit="return decideLoan(event)">
          <input type="hidden" name="uid" id="uid" value="<?= $uId ?>">
          <input type="hidden" name="time" id="time" value="<?= $_POST['time'] ?>">
          <input type="hidden" name="pro_id" id="pro_id" value="<?= $_POST['pro_id'] ?>">
          <input type="hidden" name="money" id="money" value="<?= $_POST['sum_price'] ?>">
          <div class="form-group">
            <label class="col-xs-4 cols control-label">借款用途<span class="reqire-icon"> *</span></label>
            <div class="col-xs-8 cols">
                <input class="form-control input-lg" name="card" type="text" size="35" placeholder="请输入借款用途 ">
            </div>
            </input>
          </div>

          <div class="form-group">
            <label class="col-xs-4 cols control-label">还款来源<span class="reqire-icon"> *</span></label>
            <div class="col-xs-8 cols">
                <input class="form-control input-lg" name="number" type="text" size="35" placeholder="请输入还款来源"></input>
            </div>
            </input>
          </div>
          <div class="form-group has-success checkbox-form-group">
            <div class="agree-checkbox">
              <input type="checkbox" name="agree" id="agree" checked="true" />
              <label class="checkbox-label" for="agree">
                <span>&nbsp;同意</span>
                <span class="highlight-text">&nbsp;<借款合同></span>
                <span>&nbsp; 条款，电子邮箱接收 <借款合同> 回执</span>
              </label>
            </div>  
          </div>
          
          <div>
            <label class="highlight-text">资料审核过程中， 学融宝客服人员会通过微信或QQ与您取得联系， 并完成视频认证。</label>
          </div>

          <input class="btn btn-lg btn-default submit-btn" type="submit" disabled value="确定">
        </form>
      </div>      
    </section>

    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/js.cookie.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootbox.min.js"></script>
    <script src="../assets/js/bootstrapValidator.min.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>
</html>