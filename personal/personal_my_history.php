<?php
session_start();
require_once('../api/curl.php');

if(isset($_COOKIE['uid']) && $_COOKIE['uid'] != '') {
  $uId = $_COOKIE['uid'];
  $history = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_HISTORY'], array('uId' => $uId));
  $history = json_decode($history);

  $output = '<script>console.log('.json_encode($history).')</script>';
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

    <title>学融宝 - 个人中心 - 历史记录</title>

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
  <body class="personal-page personal-my-info">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">历史记录</span>
        <div class="nav"></div>
      </nav>
    </header>
    <?php if(isset($history) && count($history->lnList->loan) > 0 ): ?>
    <section class="main no-padding">      
        <div class="history-list">
          <div class="history-block">
            <div class="history">
              <div class="history-body">活利贷 申请额度 ￥ 200</div>
              <div class="history-date">已逾期</div>
            </div>
            <div class="history">
              <div class="history-body">资料审核中</div>
              <div class="history-date">2016-05-05</div>
            </div>
            <div class="history">
              <div class="history-body">元已不发到盛京银行 （卡号： 1313131313131）</div>
              <div class="history-date">2016-05-06</div>
            </div>
            <div class="history">
              <div class="history-body">贷款已逾期, 请尽快还款</div>
              <div class="history-date">2016-05-07</div>
            </div>
          </div>
          <div class="history-block">
            <div class="history">
              <div class="history-body">活利贷 申请额度 ￥ 200</div>
              <div class="history-date overdue">已逾期</div>
            </div>
            <div class="history">
              <div class="history-body">资料审核中</div>
              <div class="history-date">2016-05-05</div>
            </div>
            <div class="history">
              <div class="history-body">元已不发到盛京银行 （卡号： 1313131313131）</div>
              <div class="history-date">2016-05-06</div>
            </div>
            <div class="history overdue">
              <div class="history-body">贷款已逾期, 请尽快还款</div>
              <div class="history-date">2016-05-07</div>
            </div>
          </div>
        </div>        
    </section>
    <?php else: ?>
      <?php 
        $title = '历史记录';
        include '../templates/error_tpl.php';
      ?>
    <?php endif; ?>  

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
