<?php
session_start();
require_once('curl.php');
$uId = $_SESSION['uid'];
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

function sendMsg($msg) {
  $msg = json_encode($msg);
  echo "data: changed\n";
  echo PHP_EOL;
  ob_flush();
  flush();
}

$result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_U_MSG'], array('uId' => $uId));
$result = json_decode($result);
  
if($result->error->errno == 200) {
  $messages = $result->msgList->msg;
  $_SESSION['personal_msgs'] = $messages;
  
  if($_SESSION['personal_msgs_count'] != count($messages)) {
    $_SESSION['personal_msgs_count'] = count($messages);
    sendMsg($messages);
  } 
  
}

?>