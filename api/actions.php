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

// Upload Image
if(isset($_POST['page']) && $_POST['page'] == 'upload_image') {
  $cfile = '';
  if(function_exists('curl_file_create')) {
    $cfile = curl_file_create($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']);
  } else {
    $cfile = "@{$_FILES['file']['tmp_name']};filename=".$_FILES['file']['name'].";type=".$_FILES['file']['type'];
  }
  $postdata = array('file' => $cfile);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_UP_IMAGE'], $postdata);
  echo $result;
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

// Get Calculator data
if(isset($_POST['page']) && $_POST['page'] == 'calculator_base') {
  $postdata = $_POST;
  unset($postdata['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_CALCULATOR'], $postdata);
  echo $result;
}

// Submit Feedback
if(isset($_POST['page']) && $_POST['page'] == 'more_feedback') {
  $postdata = $_POST;
  unset($postdata['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_U_FEEDBACK'], $postdata);
  echo $result;
}

// Search University
if(isset($_POST['page']) && $_POST['page'] == 'search_university') {
  $postdata = $_POST;
  unset($_POST['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SE_SCHOOL'], $postdata);
  echo $result;
}

// Signup Page
if(isset($_POST['page']) && $_POST['page'] == 'signup_page') {
  $postdata = $_POST;
  unset($_POST['page']);
  unset($_POST['signup_student_id']);
  unset($_POST['signgup_agree']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_U_LOGIN'], $postdata);
  $result = json_decode($result);
  if($result->error->errno == '200') {
    $uId = $result->uId;
    $_SESSION['uid'] = $uId;

    $user_temp = array(
      'uid' => $uId,
      'deviceId' => '00000000000000008:00:27:44:04:bb323ec7466101f399',
      'deviceOs' => 'Android',
      'deviceType' => 'Google Nexus S - 4.1.1 - API 16 - 480x800',
      'deviceOp' => '4.1.1',
      'version' => '1.0.1',
      'deviceToken' => 'dd'
    );

    $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $user_temp);
    $result = json_decode($result);

    if($result->error->errno == '200') {
      unset($result->error);
      $_SESSION['sys_info'] = $result;
    }

    $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_INFO'], array('uId' => $uId));
    $result = json_decode($result);

    if($result->error->errno == '200') {
      $userAllData = $result;
      unset($userAllData->error);
      $_SESSION['user_all_data'] = $userAllData;
    }

    header("Location: ../index.php");
  } else {
    $_SESSION['flash'] = $result->error->usermsg;
    header("Location: ../signup.php");
  }
}
?>
