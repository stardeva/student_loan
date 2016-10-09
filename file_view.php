<?php
require_once('api/curl.php');
require_once('api/functions.php');

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
}
if(isset($_GET['fileurl']) && $_GET['fileurl'] != '') {
  $fileurl = $_GET['fileurl'];
  $file_extension = pathinfo($fileurl);
  $file_extension = $file_extension['extension'];
}
if(isset($_GET['title']) && $_GET['title'] != '') {
  $title = $_GET['title'];
} else {
  $title = '上传方法';
}

if(isset($_GET['temp'])) {
  $_SESSION['temp'] = $_GET['temp'];
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - <?= $title ?></title>

    <!-- Bootstrap -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">

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
        <a href="<?= $previous ?>" class="nav text back left"><img src="./assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title"><?= $title ?></span>
        <div class="nav right"></div>
      </nav>
    </header>
    <section class="main no-padding" style="position: absolute;left: 0; top: 50px; bottom: 0; right: 0;">
      <?php if(isset($fileurl) && $fileurl != '') : ?>
        <?php if($file_extension == 'pdf'): ?>
          <iframe src='pdf_viewer.php?url=<?= $fileurl ?>' frameborder='0' style="width: 100%;height: 100%;"></iframe>
        <?php elseif($file_extension == 'doc' || $file_extension == 'docx'): ?>
          <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?= $fileurl ?>' frameborder='0' style="width: 100%;height: 100%;">This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
        <?php else: ?>
          <img src="<?= $fileurl ?>" class="img-responsive" />
        <?php endif; ?>
      <?php endif; ?>
    </section>

    <script type="text/javascript" src="./assets/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
  </body>
</html>
