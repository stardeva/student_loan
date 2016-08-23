<?php
session_start();
require_once('curl.php');

// Credit Base Page Submit
if(isset($_POST['page']) && $_POST['page'] == 'credit_base') {
  $back_url = $_POST['backurl'];
  $postdata = $_POST;
  unset($postdata['page']);
  unset($postdata['backurl']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_BASE'], $postdata);
  $result = json_decode($result);
  if($result->error->errno == 200) {
    $userAllData = $_SESSION['user_all_data'];
    $userAllData->cdBase = $result->cdBase;
    $_SESSION['user_all_data'] = $userAllData;
    $_SESSION['flash'] = '保存成功';
    header("Location: ../credits/index.php");
  } else {
    $_SESSION['flash'] = $result->error->usermsg;
    header("Location: ../credits/credit_base.php");
  }
}

// Credit Family Page Submit
if(isset($_POST['page']) && $_POST['page'] == 'credit_family') {
  $back_url = $_POST['backurl'];
  $postdata = $_POST;
  unset($postdata['page']);
  unset($postdata['backurl']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_UPHOME'], $postdata);
  $result = json_decode($result);
  if($result->error->errno == 200) {
    $userAllData = $_SESSION['user_all_data'];
    $userAllData->cdHome = $result->cdHome;
    $_SESSION['user_all_data'] = $userAllData;
    $_SESSION['flash'] = '保存成功';
    header("Location: ../credits/index.php");
  } else {
    $_SESSION['flash'] = $result->error->usermsg;
    header("Location: ../credits/credit_family.php");
  }
}

// Credit Family Page Submit
if(isset($_POST['page']) && $_POST['page'] == 'credit_contact') {
  $back_url = $_POST['backurl'];
  $postdata = $_POST;
  unset($postdata['page']);
  unset($postdata['backurl']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_UPSCHOOL'], $postdata);
  $result = json_decode($result);
  if($result->error->errno == 200) {
    $userAllData = $_SESSION['user_all_data'];
    $userAllData->cdSchool = $result->cdSchool;
    $_SESSION['user_all_data'] = $userAllData;
    $_SESSION['flash'] = '保存成功';
    header("Location: ../credits/index.php");
  } else {
    $_SESSION['flash'] = $result->error->usermsg;
    header("Location: ../credits/credit_contact.php");
  }
}

// Credit Other Page Submit
if(isset($_POST['page']) && $_POST['page'] == 'credit_other') {
  $back_url = $_POST['backurl'];
  $postdata = $_POST;
  unset($postdata['page']);
  unset($postdata['backurl']);
  $postdata['bankPics'] = implode(',', $postdata['bankPics']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_LIFE'], $postdata);
  $result = json_decode($result);
  if($result->error->errno == 200) {
    $userAllData = $_SESSION['user_all_data'];
    $userAllData->cdLife = $result->cdLife;
    $_SESSION['user_all_data'] = $userAllData;
    $_SESSION['flash'] = '保存成功';
    header("Location: ../credits/index.php");
  } else {
    $_SESSION['flash'] = $result->error->usermsg;
    header("Location: ../credits/credit_other.php");
  }
}

// Upload Personal Image
if(isset($_POST['page']) && $_POST['page'] == 'personal_info') {
  $postdata = $_POST;
  unset($postdata['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_U_UPPORTRAIT'], $postdata);
  $result = json_decode($result);
  if($result->error->errno == 200) {
    $userAllData = $_SESSION['user_all_data'];
    $userAllData->user = $result->user;
    $_SESSION['user_all_data'] = $userAllData;
  }
  echo json_encode($result);
}

// Bind Band Card
if(isset($_POST['page']) && $_POST['page'] == 'personal_bind_card') {
  $postdata = $_POST;
  unset($postdata['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_U_BANK'], $postdata);
  $result = json_decode($result);
  if($result->error->errno == 200) {
    $userAllData = $_SESSION['user_all_data'];
    $userAllData->user = $result->user;
    $_SESSION['user_all_data'] = $userAllData;
  }
  echo json_encode($result);
}

// Bind Band Card
if(isset($_POST['page']) && $_POST['page'] == 'personal_unbind_card') {
  $postdata = $_POST;
  unset($postdata['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_U_UNBANK'], $postdata);
  $result = json_decode($result);
  if($result->error->errno == 200) {
    $userAllData = $_SESSION['user_all_data'];
    $userAllData->user = $result->user;
    $_SESSION['user_all_data'] = $userAllData;
  }
  echo json_encode($result);
}

// Bind Band Card
if(isset($_POST['page']) && $_POST['page'] == 'personal_coin_mall') {
  $postdata = $_POST;
  unset($postdata['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_MALL_LIST'], $postdata);
  echo $result;
}
?>
