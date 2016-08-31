<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

$backurl = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
  if(strpos($_SERVER['HTTP_REFERER'], 'message_tpl') !== false)
    $backurl = './';
  else
    $backurl = $_SERVER['HTTP_REFERER'];
}

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
  <body class="personal-page personal-my-message">
    <header class="header">
      <nav class="topnav">
        <a href="<?= $backurl ?>" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">消息</span>
        <div class="nav"></div>
      </nav>
    </header>
    <?php if(isset($messages) && count($messages) > 0): ?>
    <section class="main no-padding">
      <div class="messages-list">
        <?php foreach($messages as $msg): ?>
        <?php
          $msg_url = '';
          switch($msg->mType) {
          case 2: case 5:
            $msg_url = '../refund';
            break;
          case 3: case 4:
            $msg_url = '../credits';
            break;
          case 6:
            $msg_url = '../estimate';
            break;
          default:
            $msg_url = '../templates/message_tpl.php?msg_id='.$msg->mId;
          }
        ?>
        <a href="<?= $msg_url ?>" class="message <?= messageIcon($msg->mType) ?> unread">
          <div class="message-body">
            <div class="message-title"><?= $msg->title ?></div>
            <div class="message-date"><?php echo date('Y-m-d', $msg->time); ?></div>
          </div>
          <div class="message-content"><?= mb_strcut($msg->content, 0, 200, 'UTF-8').(mb_strlen($msg->content, 'UTF-8') > 200 ? '...' : '') ?></div>
        </a>
        <?php endforeach; ?>
      </div>
    </section>
    <?php else: ?>
      <?php 
        $title = '暂无消息';
        $error_type = 'message';
        include '../templates/error_tpl.php';
      ?>
    <?php endif; ?>

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
 