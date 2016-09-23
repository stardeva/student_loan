<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

$result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_EVALUATE'], array());
$result = json_decode($result);

if($result->error->errno == 200) {
  $evaluateList = $result->evaluateList->evaluate;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 用户评价</title>

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
  <body class="evaluate-page evaluate-view-page personal-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">用户评价</span>
        <div class="nav"></div>
      </nav>
    </header>

    <?php if(isset($evaluateList) && count($evaluateList) > 0): ?>
    <section class="loan-data-area main-loan-area">
      <div class="main-wrap user-estimate-area">
        
          <?php 
            foreach ($evaluateList as $item) {
          ?>
            <div class="estimate-group flex-wrap-space">
              <div class="content">
                <div class="user-name flex-wrap-space">
                  <div class="user-head emoticon">
                    <div class="user-head-image image"></div>
                  </div>
                  <div class="name title">
                    <?php echo $item->name ?>                    
                  </div>
                </div>
                <div class="active-money title">
                  <?php echo $item->title ?>
                </div>
                <div class="power text-center">
                  <?php echo $item->content ?>                
                </div>
              </div>

              <div class="user-mark flex-wrap-space">
                <div class="date"><?php echo date('Y-m-d', $item->time); ?></div>
                <div class="mark-wrap">
                  <?php 
                    for($i = 0; $i < $item->star; $i ++) {
                      echo "<div class='mark-image active image'></div>";
                    }
                  ?>
                </div>
              </div>
            </div>            
          <?php
            }
          ?>
      </div>      
    </section>
    <?php else: ?>
      <?php 
        $title = '暂无评价';
        $error_type = 'evaluate';
        include '../templates/error_tpl.php';
      ?>
    <?php endif; ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-1.12.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>
</html>