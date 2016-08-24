<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

if(checkUserLogin()) {
  $userAllData = $_SESSION['user_all_data'];
  $uId = $_SESSION['uid'];
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
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">联系资料</span>
        <a href="" class="nav text next">完成</a>
      </nav>
    </header>
    <section class="main">
      <div class="info-box">
        注: 填写全都必填信才能点亮图标<br />手机号码我们不会主动拨打， 仅作为紧急联系使用
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
                <input type="text" name="faCompany" id="credit_contact_father_company" required="true" value="<?= $userAllData->cdSchool->faCompany ?>" placeholder="请输入工作单位" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_father_company_address" class="required">单位地址</label>
              <div class="input-holder">
                <input type="text" name="faCompanyAddr" id="credit_contact_father_company_address" required="true" value="<?= $userAllData->cdSchool->faCompanyAddr ?>" placeholder="请输入单位地址" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_father_duty" class="required">职务</label>
              <div class="input-holder">
                <input type="text" name="faDuty" id="credit_contact_father_duty" required="true" value="<?= $userAllData->cdSchool->faDuty ?>" placeholder="请输入职务" />
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
                <input type="text" name="moCompany" id="credit_contact_mother_company" required="true" value="<?= $userAllData->cdSchool->moCompany ?>" placeholder="请输入工作单位" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_mother_company_address" class="required">单位地址</label>
              <div class="input-holder">
                <input type="text" name="moCompanyAddr" id="credit_contact_mother_company_address" required="true" value="<?= $userAllData->cdSchool->moCompanyAddr ?>" placeholder="请输入单位地址" />
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_contact_mother_duty" class="required">职务</label>
              <div class="input-holder">
                <input type="text" name="moDuty" id="credit_contact_mother_duty" required="true" value="<?= $userAllData->cdSchool->moDuty ?>" placeholder="请输入职务" />
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
                <input type="text" name="homeAddr" id="credit_contact_home_address" required="true" value="<?= $userAllData->cdSchool->homeAddr ?>" placeholder="请具体到x路x街x小区名x房间" />
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
                <input type="text" name="caName" id="credit_contact_classmate1_fullname" required="true" value="<?= $userAllData->cdSchool->caName ?>" placeholder="请输入姓名" />
              </div>
            </div>
          </div>
          <div class="form-element width-45pc">
            <div class="select-block">
              <label for="credit_contact_classmate1_sex" class="required">性别</label>
              <div class="input-holder">
                <select name="caSex" id="credit_contact_classmate1_sex" required="true">
                  <option <?php echo $userAllData->cdSchool->caSex == 1 ? 'selected="selected"' : '' ?> value="1">男</option>
                  <option <?php echo $userAllData->cdSchool->caSex == 2 ? 'selected="selected"' : '' ?> value="2">女</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-element width-100pc">
              <div class="input-block">
                <label for="credit_contact_classmate1_mobile" class="required">手机</label>
                <div class="input-holder">
                  <input type="tel" name="caPhone" id="credit_contact_classmate1_mobile" required="true" class="phone" value="<?= $userAllData->cdSchool->caPhone ?>" placeholder="请输入手机号" />
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
                <input type="text" name="caDormAddr" id="credit_contact_classmate1_address" required="true" value="<?= $userAllData->cdSchool->caDormAddr ?>" placeholder="请输入寝室地址" />
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
                <input type="text" name="cbName" id="credit_contact_classmate2_fullname" required="true" value="<?= $userAllData->cdSchool->cbName ?>" placeholder="请输入姓名" />
              </div>
            </div>
          </div>
          <div class="form-element width-45pc">
            <div class="select-block">
              <label for="credit_contact_classmate2_sex" class="required">性别</label>
              <div class="input-holder">
                <select name="cbSex" id="credit_contact_classmate2_sex" required="true">
                  <option <?php echo $userAllData->cdSchool->cbSex == 1 ? 'selected="selected"' : '' ?> value="1">男</option>
                  <option <?php echo $userAllData->cdSchool->cbSex == 2 ? 'selected="selected"' : '' ?> value="2">女</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-element width-100pc">
              <div class="input-block">
                <label for="credit_contact_classmate2_mobile" class="required">手机</label>
                <div class="input-holder">
                  <input type="tel" name="cbPhone" id="credit_contact_classmate2_mobile" required="true" class="phone" value="<?= $userAllData->cdSchool->cbPhone ?>" placeholder="请输入手机号" />
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
                <input type="text" name="cbDormAddr" id="credit_contact_classmate2_address" required="true" value="<?= $userAllData->cdSchool->cbDormAddr ?>" />
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
                <span>点击查看上传方法</span>
              </div>
              <div class="input-holder">
                <div class="file-input" style="<?php echo isset($userAllData->cdSchool->handPic) && $userAllData->cdSchool->handPic !='' ? 'background-position: -9999px;' : ''; ?>">
                  <label class="required <?php echo isset($userAllData->cdSchool->handPic) && $userAllData->cdSchool->handPic !='' ? 'hidden' : ''; ?>">正面照片上传</label>
                  <input type="file" required="true" accept='image/*' class="file-upload" />
                  <img class="image-preview <?php echo isset($userAllData->cdSchool->handPic) && $userAllData->cdSchool->handPic !='' ? '' : 'hidden'; ?>" src="<?php if(isset($userAllData->cdSchool->handPic) && $userAllData->cdSchool->handPic != '') echo $userAllData->cdSchool->handPic; ?>" />
                  <input type="hidden" name="handPic" class="file-key" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>

    <div class="notification-popup"></div>

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>

    <script type="text/javascript" src="../assets/js/api.js"></script>
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
            }, 1000);
          }
        });
      });
    </script>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
  </body>
</html>
