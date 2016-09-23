<?php
require_once('../api/functions.php');

if(checkUserLogin()) {
  
  if(isset($_SESSION['personal_msgs'])) {
    foreach($_SESSION['personal_msgs'] as $item) {
      if($item->mId == $_GET['msg_id']) {
        $message = $item;
        break;
      }
    }
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
    <meta HTTP-http-equiv="content-type" content="text/html; charset=charset_name">

    <title>学融宝 - 消息</title>

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
  <body class="personal-page">
    <header class="header">
      <nav class="topnav">
        <a href="../personal/personal_my_messages.php" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title"><?php echo mb_strcut($message->title, 0, 28, 'UTF-8').(mb_strlen($message->title, 'UTF-8') > 14 ? '...' : ''); ?></span>
        <div class="nav"></div>
      </nav>
    </header>

    <section class="message-template-area">
      <?php if(isset($message)): ?>
        <div class="title"><b><?= $message->title ?></b></div>
        <div class="date"><?php echo date('Y-m-d', $message->time) ?></div>
        <div class="content"><?= $message->content ?></div>
      <?php endif; ?>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-1.12.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>