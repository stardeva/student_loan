<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $userAllData = $_SESSION['user_all_data'];
  $uId = $_SESSION['uid'];
  $sys_info = $_SESSION['sys_info'];
  $previous = "javascript:history.go(-1)";
  if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
    if(strpos($previous, 'credit_base.php') !== false) setcookie('back', true, time() + 60);
  }
  if(isset($_GET['fileurl']) && $_GET['fileurl'] != '')
  {
    $fileurl = $_GET['fileurl'];
    $file_extension = pathinfo($fileurl)['extension'];
  }
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

    <title>学融宝 - 上传方法</title>

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
  <body class="credits-page credit-family-page form-page">
    <header class="header">
      <nav class="topnav">
        <a href="<?= $previous ?>" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">上传方法</span>
        <div class="nav"></div>
      </nav>
    </header>
    <section class="main no-padding">
      <?php if(isset($fileurl) && $fileurl != '') : ?>
        <?php if($file_extension == 'pdf'): ?>
          <script type="text/javascript">
            
          </script>
        <?php else: ?>
          <img src="<?= $fileurl ?>" class="img-responsive" />
        <?php endif; ?>
      <?php endif; ?>
    </section>

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/pdf.js"></script>
    <script type="text/javascript" src="../assets/js/pdf.worker.js"></script>

    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
