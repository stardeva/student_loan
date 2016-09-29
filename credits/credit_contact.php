<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

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

  $result = httpPost($API_HOST.$API_ENDPOINTS['ADDRESS_SYS_INIT'], $USER_TEMP);
  $result = json_decode($result);

  if($result->error->errno == '200') {
    unset($result->error);
    $_SESSION['sys_info'] = $result;
  }

  $contract = $_SESSION['sys_info']->contract;

  if(isset($_SESSION['temp']) && isset($_SESSION['temp']['credit_contact'])) {
    $temp = $_SESSION['temp']['credit_contact'];
    unset($_SESSION['temp']);
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

    <title>学融宝 - 信用额度 - 联系资料</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="credits-page credit-contact-page form-page">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back left"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">联系资料</span>
        <a href="" class="nav text next right">完成</a>
      </nav>
    </header>
    <section class="main">
      <div class="info-box">
        注： 填写全部必填信息才能点亮图标<br />手机号码我们不会主动拨打， 仅作为紧急联系使用
      </div>
      <form action="../api/actions.php" id="credit_contact" name="credit_contact" method="post">
        <input type="hidden" name="uId" value="<?= $uId ?>" />
        <input type="hidden" name="page" value="credit_contact" />
        <input type="hidden" name="backurl" value="../credits/credit_contact.php" />
        <h4>父亲信息: </h4>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_father_company" class="required">工作单位</label>
              <div class="input-holder">
                <input type="text" name="faCompany" id="credit_contact_father_company" required="true" value="<?= isset($temp['faCompany']) ? $temp['faCompany'] : $userAllData->cdSchool->faCompany ?>" placeholder="请输入工作单位" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_father_company_address" class="required">单位地址</label>
              <div class="input-holder">
                <input type="text" name="faCompanyAddr" id="credit_contact_father_company_address" required="true" value="<?= isset($temp['faCompanyAddr']) ? $temp['faCompanyAddr'] : $userAllData->cdSchool->faCompanyAddr ?>" placeholder="请具体到X路X街X号" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_father_duty" class="required">职务</label>
              <div class="input-holder">
                <input type="text" name="faDuty" id="credit_contact_father_duty" required="true" value="<?= isset($temp['faDuty']) ? $temp['faDuty'] : $userAllData->cdSchool->faDuty ?>" placeholder="请输入职务" />
              </div>
            </div>
          </div>
        </div>
        <h4>母亲信息: </h4>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_mother_company" class="required">工作单位</label>
              <div class="input-holder">
                <input type="text" name="moCompany" id="credit_contact_mother_company" required="true" value="<?= isset($temp['moCompany']) ? $temp['moCompany'] : $userAllData->cdSchool->moCompany ?>" placeholder="请输入工作单位" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_mother_company_address" class="required">单位地址</label>
              <div class="input-holder">
                <input type="text" name="moCompanyAddr" id="credit_contact_mother_company_address" required="true" value="<?= isset($temp['moCompanyAddr']) ? $temp['moCompanyAddr'] : $userAllData->cdSchool->moCompanyAddr ?>" placeholder="请具体到X路X街X号" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_mother_duty" class="required">职务</label>
              <div class="input-holder">
                <input type="text" name="moDuty" id="credit_contact_mother_duty" required="true" value="<?= isset($temp['moDuty']) ? $temp['moDuty'] : $userAllData->cdSchool->moDuty ?>" placeholder="请输入职务" />
              </div>
            </div>
          </div>
        </div>
        <br />
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_home_address" class="required">家庭住址</label>
              <div class="input-holder">
                <input type="text" name="homeAddr" id="credit_contact_home_address" required="true" value="<?= isset($temp['homeAddr']) ? $temp['homeAddr'] : $userAllData->cdSchool->homeAddr ?>" placeholder="请具体到x路x街x小区名x房间" />
              </div>
            </div>
          </div>
        </div>
        <h4>联系人同学一:</h4>
        <div class="form-row">
          <div class="form-element width-55pc">
            <div class="input-block">
              <label for="credit_contact_classmate1_fullname" class="required">姓名</label>
              <div class="input-holder">
                <input type="text" name="caName" id="credit_contact_classmate1_fullname" required="true" value="<?= isset($temp['caName']) ? $temp['caName'] : $userAllData->cdSchool->caName ?>" placeholder="请输入姓名" />
              </div>
            </div>
          </div>
          <div class="form-element width-45pc">
            <div class="select-block">
              <label for="credit_contact_classmate1_sex" class="required" style="width: 60px;">性别</label>
              <div class="input-holder">
                <select name="caSex" id="credit_contact_classmate1_sex" required="true">
                  <option <?php echo (isset($temp['caSex']) ? $temp['caSex'] : $userAllData->cdSchool->caSex) == 1 ? 'selected="selected"' : '' ?> value="1">男</option>
                  <option <?php echo (isset($temp['caSex']) ? $temp['caSex'] : $userAllData->cdSchool->caSex) == 2 ? 'selected="selected"' : '' ?> value="2">女</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-element width-100pc">
              <div class="input-block">
                <label for="credit_contact_classmate1_mobile" class="required">手机</label>
                <div class="input-holder">
                  <input type="tel" name="caPhone" id="credit_contact_classmate1_mobile" required="true" class="" value="<?= isset($temp['caPhone']) ? $temp['caPhone'] : $userAllData->cdSchool->caPhone ?>" placeholder="请输入手机号" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_classmate1_address" class="required">寝室地址</label>
              <div class="input-holder">
                <input type="text" name="caDormAddr" id="credit_contact_classmate1_address" required="true" value="<?= isset($temp['caDormAddr']) ? $temp['caDormAddr'] : $userAllData->cdSchool->caDormAddr ?>" placeholder="请具体到X栋X号房间" />
              </div>
            </div>
          </div>
        </div>
        <h4>联系人同学二:</h4>
        <div class="form-row">
          <div class="form-element width-55pc">
            <div class="input-block">
              <label for="credit_contact_classmate2_fullname" class="required">姓名</label>
              <div class="input-holder">
                <input type="text" name="cbName" id="credit_contact_classmate2_fullname" required="true" value="<?= isset($temp['cbName']) ? $temp['cbName'] : $userAllData->cdSchool->cbName ?>" placeholder="请输入姓名" />
              </div>
            </div>
          </div>
          <div class="form-element width-45pc">
            <div class="select-block">
              <label for="credit_contact_classmate2_sex" class="required" style="width: 60px;">性别</label>
              <div class="input-holder">
                <select name="cbSex" id="credit_contact_classmate2_sex" required="true">
                  <option <?php echo (isset($temp['cbSex']) ? $temp['cbSex'] : $userAllData->cdSchool->cbSex) == 1 ? 'selected="selected"' : '' ?> value="1">男</option>
                  <option <?php echo (isset($temp['cbSex']) ? $temp['cbSex'] : $userAllData->cdSchool->cbSex) == 2 ? 'selected="selected"' : '' ?> value="2">女</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-element width-100pc">
              <div class="input-block">
                <label for="credit_contact_classmate2_mobile" class="required">手机</label>
                <div class="input-holder">
                  <input type="tel" name="cbPhone" id="credit_contact_classmate2_mobile" required="true" class="" value="<?= isset($temp['cbPhone']) ? $temp['cbPhone'] : $userAllData->cdSchool->cbPhone ?>" placeholder="请输入手机号" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_classmate2_address" class="required">寝室地址</label>
              <div class="input-holder">
                <input type="text" name="cbDormAddr" id="credit_contact_classmate2_address" required="true" value="<?= isset($temp['cbDormAddr']) ? $temp['cbDormAddr'] : $userAllData->cdSchool->cbDormAddr ?>" placeholder="请具体到X栋X号房间" />
              </div>
            </div>
          </div>
        </div>
        <h4>补充信息:</h4>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="file-block">
              <div class="input-label">
                <label for="credit_contact_handheld_id_photo" class="required">手持身份证照片</label>
                <a href="javascript: void(0);" class="remind-link" data-file-url="<?= $contract->hand ?>">点击查看上传方法</a>
              </div>
              <div class="input-holder">
                <?php
                  $handPic = isset($temp['handPic']) ? $temp['handPic'] : (isset($userAllData->cdBase->handPic) ? basename($userAllData->cdBase->handPic) : '');
                ?>
                <div class="file-input" style="<?php echo $handPic !='' ? 'background-position: -9999px;' : ''; ?>">
                  <label class="required <?php echo $handPic !='' ? 'hidden' : ''; ?>">正面照片上传</label>
                  <input type="file" required="true" accept='image/*' class="file-upload" />
                  <img class="image-preview <?php echo $handPic !='' ? '' : 'hidden'; ?>" src="<?php if($handPic != '') echo $FILE_UPLOAD_URL.$handPic; ?>" />
                  <input type="hidden" name="handPic" class="file-key" <?php if($handPic != '') echo ' value="'.$handPic.'" '; ?> />
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>

    <div class="notification-popup"></div>

    <script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>

    <?php if(isset($_SESSION['flash']) && $_SESSION['flash'] != '') : ?>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.notification-popup').html("<?= $_SESSION['flash'] ?>");
        $('.notification-popup').popup({
          autoopen: true,
          blur: false,
          onopen: function() {
            setTimeout(function() {
              $('.notification-popup').popup('hide');
            }, notifyTime);
          }
        });
      });
    </script>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
  </body>
</html>
