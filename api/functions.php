<?php
session_start();

// Check if user logged in
function checkUserLogin() {
  return isset($_SESSION['uid']) && !empty($_SESSION['uid']) && isset($_SESSION['user_all_data']) && !empty($_SESSION['user_all_data']);
}

// Return message icon
function messageIcon($m_type) {
  $icon = '';
  switch($m_type) {
    case 1:
      $icon = 'message-system';
      break;
    case 2:
      $icon = 'message-overdue';
      break;
    case 3:
      $icon = 'message-audit-success';
      break;
    case 4:
      $icon = 'message-payoff';
      break;
    case 5:
      $icon = 'message-repayment';
      break;
    case 6:
      $icon = 'message-seek';
      break;
    default:
      $icon = 'message-system';
  }
  return $icon;
}

// variables for calculator page
$array_tab_id = array('fuli', 'huoli', 'yueli');
$array_time = array('天', '天', '月');

// Return loan status
function getLoanStatus($status_num) {
  switch($status_num) {
    case 0:
      return "待审核";
    case 1:
      return "审核不通过";
    case 2:
      return "还款中";
    case 3:
      return "已还完";
    case 4:
      return "已逾期";
  }
  return '';
}

// Check string
function checkString($string) {
  if(is_null($string)) {
    return false;
  }

  $string = str_replace(' ', '', $string);

  if(strlen($string) == 0) {
    return false;
  }

  return true;
}
?>
