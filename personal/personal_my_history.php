<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $uId = $_SESSION['uid'];
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_INFO'], array('uId' => $uId));
  $result = json_decode($result);

  if($result->error->errno == 200) {
    $userAllData = $result;
    unset($userAllData->error);
    $_SESSION['user_all_data'] = $userAllData;
    $_SESSION['uid'] = $uId;
  }

  $userAllData = $_SESSION['user_all_data'];

  $history = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_HISTORY'], array('uId' => $uId));
  $history = json_decode($history);

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
    <meta name = "format-detection" content = "telephone=no">

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
        <a href="./" class="nav text back left"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">历史记录</span>
        <div class="nav right"></div>
      </nav>
    </header>
    <?php if(isset($history) && count($history->lnList->loan) > 0): ?>
      <section class="main no-padding">
        <div class="history-list">
          <?php foreach($history->lnList->loan as $loan) : ?>
            <div class="history-block">
              <div class="history head">
                <div class="history-body"><?= $loan->name ?> 申请额度 ￥ <?= $loan->money ?></div>
                <div class="history-date" style="color: #<?php echo $loan->status == 4 ? 'f00' : '999'; ?>;"><?= getLoanStatus($loan->status) ?></div>
                <div class="clearfix"></div>
              </div>
              <?php foreach($loan->hisList->loanHis as $his) : ?>
                <div class="history" style="color: #<?php echo isset($his->color) && $his->color == 16730112 ? 'f00' : '999'; ?>;">
                  <div class="history-body"><?= $his->his ?></div>
                  <div class="history-date"><a href="javascript: void(0);" style="color: #<?php echo isset($his->color) && $his->color == 16730112 ? 'f00' : '999'; ?>;"><?= date('Y-m-d', $his->hisTime) ?></a></div>
                  <div class="clearfix"></div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    <?php else: ?>
      <?php 
        $title = '暂无历史记录';
        $error_type = 'history';
        include '../templates/error_tpl.php';
      ?>
    <?php endif; ?>  

    <script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
