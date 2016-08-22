<?php
session_start();

// Check if user logged in
function checkUserLogin() {
  return isset($_SESSION['uid']) && !empty($_SESSION['uid']) && isset($_SESSION['user_all_data']) && !empty($_SESSION['user_all_data']);
}
?>
