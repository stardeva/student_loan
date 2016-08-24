<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $userAllData = $_SESSION['user_all_data'];
  $uId = $_SESSION['uid'];
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_U_MSG'], array('uId' => $uId));
  $result = json_decode($result);
  
  if($result->error->errno == 200) {
    $messages = $result->msgList->msg;
    $_SESSION['personal_msgs'] = $messages;
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

    <title>学融宝 - 个人中心 - 消息</title>

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
        <span class="nav text title">消息</span>
        <div class="nav"></div>
      </nav>
    </header>
    <section class="main no-padding">
      <?php if(isset($messages)): ?>
      <div class="messages-list">
        <?php foreach($messages as $msg): ?>
        <a href="../templates/message_tpl.php?msg_id=<?= $msg->mId ?>" class="message review-failed unread">
          <div class="message-body">
            <div class="message-title"><span><?= $msg->title ?></span></div>
            <div class="message-content"><?= $msg->content ?></div>
          </div>
          <div class="message-date"><?php echo date('Y-m-d', $msg->time); ?></div>
        </a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </section>

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
 