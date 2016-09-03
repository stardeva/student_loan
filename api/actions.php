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

// Credit Contact Page Submit
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

// Mall List
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
  $backurl = $_POST['backurl'];
  unset($_POST['page']);
  unset($_POST['signup_student_id']);
  unset($_POST['signgup_agree']);
  unset($_POST['backurl']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_U_LOGIN'], $postdata);
  $result = json_decode($result);
  if($result->error->errno == '200') {
    $uId = $result->uId;
    $_SESSION['uid'] = $uId;

    $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $USER_TEMP);
    $result = json_decode($result);

    if($result->error->errno == '200') {
      unset($result->error);
      $_SESSION['sys_info'] = $result;
    }

    $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_CALCULATOR'], array('uId' => $uId));
    $result = json_decode($result);
    if($result->error->errno == '200') {
      unset($result->error);
      $_SESSION['ln_calculator'] = $result;
    }

    $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_CD_INFO'], array('uId' => $uId));
    $result = json_decode($result);

    if($result->error->errno == '200') {
      $userAllData = $result;
      unset($userAllData->error);
      $_SESSION['user_all_data'] = $userAllData;
    }

    if($backurl == '') $backurl = '../index.php';
    header("Location: " . $backurl);
  } else {
    $_SESSION['flash'] = $result->error->usermsg;
    header("Location: ../signup.php");
  }
}

// Request Loan Page
if(isset($_POST['page']) && $_POST['page'] == 'request_loan_page') {
  $postdata = $_POST;
  unset($_POST['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_APPLY'], $postdata);
  echo $result;
}

// Help page
if(isset($_GET['page']) && $_GET['page'] == 'help_page') {
  $postdata = $_GET;
  $url = $_GET['url'];
  $result = httpGet($url);
  echo $result;
}

// Receive feedback
if(isset($_POST['page']) && $_POST['page'] == 'set_estimate_page') {
  $postdata = $_POST;
  unset($_POST['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_LN_SEVALUATE'], $postdata);
  echo $result;
}

// sred activity page
if(isset($_POST['page']) && $_POST['page'] == 'sred_activity_page') {
  $postdata = $_POST;
  unset($_POST['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_SRED'], $postdata);
  echo $result;
}

// red activity page
if(isset($_POST['page']) && $_POST['page'] == 'red_activity_page') {
  $postdata = $_POST;
  unset($_POST['page']);
  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_RED'], $postdata);
  echo $result;
}

// Log out page
if(isset($_POST['page']) && $_POST['page'] == 'logout') {
  session_destroy();
}
?>
