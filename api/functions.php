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
?>
