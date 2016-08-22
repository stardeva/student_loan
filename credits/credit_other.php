<?php
session_start();
require_once('../api/curl.php');
if(isset($_SESSION['user_all_data']) && !empty($_SESSION['user_all_data'])) {
  $userAllData = $_SESSION['user_all_data'];
  $uId = $_SESSION['uid'];
  $bankPics = explode(',', $userAllData->cdLife->bankPics);
} else {
  header("Location: ../signup.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>学融宝 - 信用额度 - 补充资料</title>

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
  <body class="credits-page credit-other-page form-page">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">补充资料</span>
        <a href="" class="nav text next">完成</a>
      </nav>
    </header>
    <section class="main">
      <div class="info-box">
        注: 填写全都必填信才能点亮图标<br />手机号码我们不会主动拨打， 仅作为紧急联系使用
      </div>
      <form action="../api/actions.php" id="credit_other" name="credit_other" method="post">
        <input type="hidden" name="uId" value="<?= $uId ?>" />
        <input type="hidden" name="page" value="credit_other" />
        <input type="hidden" name="backurl" value="../credits/credit_other.php" />
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="file-block">
              <div class="input-label">
                <label for="credit_other_website_screenshot" class="required">手机信息运营商网站截图</label>
                <span>点击查看上传方法</span>
              </div>
              <div class="input-holder">
                <div class="file-input" style="<?php echo isset($userAllData->cdLife->phInfoPic) && $userAllData->cdLife->phInfoPic !='' ? 'background-position: -9999px;' : ''; ?>">
                  <label class="required <?php echo isset($userAllData->cdLife->phInfoPic) && $userAllData->cdLife->phInfoPic !='' ? 'hidden' : ''; ?>">上传照片</label>
                  <input type="file" required="true" accept='image/*' class="file-upload" />
                  <img class="image-preview <?php echo isset($userAllData->cdLife->phInfoPic) && $userAllData->cdLife->phInfoPic !='' ? '' : 'hidden'; ?>" src="<?php if(isset($userAllData->cdLife->phInfoPic) && $userAllData->cdLife->phInfoPic != '') echo $userAllData->cdLife->phInfoPic; ?>" />
                  <input type="hidden" name="phInfoPic" class="file-key" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <br />
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="file-block">
              <div class="input-label">
                <label for="credit_other_banks" class="required">近6个月银行流水</label>
              </div>
              <div class="input-holder">
                <div class="file-input" style="<?php echo isset($bankPics[0]) && $bankPics[0] !='' ? 'background-position: -9999px;' : ''; ?>">
                  <label class="required <?php echo isset($bankPics[0]) && $bankPics[0] !='' ? 'hidden' : ''; ?>">上传照片</label>
                  <input type="file" required="true" accept='image/*' class="file-upload" />
                  <img class="image-preview <?php echo isset($bankPics[0]) && $bankPics[0] !='' ? '' : 'hidden'; ?>" src="<?php if(isset($bankPics[0]) && $bankPics[0] !='') echo $bankPics[0]; ?>" />
                  <input type="hidden" name="bankPics[]" class="file-key" />
                </div>
                <div class="file-input" style="<?php echo isset($bankPics[1]) && $bankPics[1] !='' ? 'background-position: -9999px;' : ''; ?>">
                  <label class="required <?php echo isset($bankPics[1]) && $bankPics[1] !='' ? 'hidden' : ''; ?>">上传照片</label>
                  <input type="file" required="true" accept='image/*' class="file-upload" />
                  <img class="image-preview <?php echo isset($bankPics[1]) && $bankPics[1] !='' ? '' : 'hidden'; ?>" src="<?php if(isset($bankPics[1]) && $bankPics[1] !='') echo $bankPics[1]; ?>" />
                  <input type="hidden" name="bankPics[]" class="file-key" />
                </div>
                <div class="file-input" style="<?php echo isset($bankPics[2]) && $bankPics[2] !='' ? 'background-position: -9999px;' : ''; ?>">
                  <label class="required <?php echo isset($bankPics[2]) && $bankPics[2] !='' ? 'hidden' : ''; ?>">上传照片</label>
                  <input type="file" required="true" accept='image/*' class="file-upload" />
                  <img class="image-preview <?php echo isset($bankPics[2]) && $bankPics[2] !='' ? '' : 'hidden'; ?>" src="<?php if(isset($bankPics[2]) && $bankPics[2] !='') echo $bankPics[2]; ?>" />
                  <input type="hidden" name="bankPics[]" class="file-key" />
                </div>
                <div class="file-input" style="<?php echo isset($bankPics[3]) && $bankPics[3] !='' ? 'background-position: -9999px;' : ''; ?>">
                  <label class="required <?php echo isset($bankPics[3]) && $bankPics[3] !='' ? 'hidden' : ''; ?>">上传照片</label>
                  <input type="file" required="true" accept='image/*' class="file-upload" />
                  <img class="image-preview <?php echo isset($bankPics[3]) && $bankPics[3] !='' ? '' : 'hidden'; ?>" src="<?php if(isset($bankPics[3]) && $bankPics[3] !='') echo $bankPics[3]; ?>" />
                  <input type="hidden" name="bankPics[]" class="file-key" />
                </div>
                <div class="file-input" style="<?php echo isset($bankPics[4]) && $bankPics[4] !='' ? 'background-position: -9999px;' : ''; ?>">
                  <label class="required <?php echo isset($bankPics[4]) && $bankPics[4] !='' ? 'hidden' : ''; ?>">上传照片</label>
                  <input type="file" required="true" accept='image/*' class="file-upload" />
                  <img class="image-preview <?php echo isset($bankPics[4]) && $bankPics[4] !='' ? '' : 'hidden'; ?>" src="<?php if(isset($bankPics[4]) && $bankPics[4] !='') echo $bankPics[4]; ?>" />
                  <input type="hidden" name="bankPics[]" class="file-key" />
                </div>
                <div class="file-input" style="<?php echo isset($bankPics[5]) && $bankPics[5] !='' ? 'background-position: -9999px;' : ''; ?>">
                  <label class="required <?php echo isset($bankPics[5]) && $bankPics[5] !='' ? 'hidden' : ''; ?>">上传照片</label>
                  <input type="file" required="true" accept='image/*' class="file-upload" />
                  <img class="image-preview <?php echo isset($bankPics[5]) && $bankPics[5] !='' ? '' : 'hidden'; ?>" src="<?php if(isset($bankPics[5]) && $bankPics[5] !='') echo $bankPics[5]; ?>" />
                  <input type="hidden" name="bankPics[]" class="file-key" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <h4>联系人老师一:</h4>
        <div class="form-row">
          <div class="form-element width-55pc">
            <div class="input-block">
              <label for="credit_other_teacher1_fullname" class="required">姓名</label>
              <div class="input-holder">
                <input type="text" name="taName" id="credit_other_teacher1_fullname" required="true" value="<?= $userAllData->cdLife->taName ?>" placeholder="请输入姓名" />
              </div>
            </div>
          </div>
          <div class="form-element width-45pc">
            <div class="select-block">
              <label for="credit_other_teacher1_sex" class="required">性别</label>
              <div class="input-holder">
                <select name="taSex" id="credit_other_teacher1_sex" required="true">
                  <option <?php echo $userAllData->cdLife->taSex == 1 ? 'selected="selected"' : '' ?> value="1">男</option>
                  <option <?php echo $userAllData->cdLife->taSex == 2 ? 'selected="selected"' : '' ?> value="2">女</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-element width-100pc">
              <div class="input-block">
                <label for="credit_other_teacher1_mobile" class="required">手机</label>
                <div class="input-holder">
                  <input type="text" name="taPhone" id="credit_other_teacher1_mobile" required="true" class="phone" value="<?= $userAllData->cdLife->taPhone ?>" placeholder="请输入手机号" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_other_teacher1_job" class="required">职务</label>
              <div class="input-holder">
                <input type="text" name="taDuty" id="credit_other_teacher1_job" required="true" value="<?= $userAllData->cdLife->taDuty ?>" placeholder="请输入职务" />
              </div>
            </div>
          </div>
        </div>
        <h4>联系人老师二:</h4>
        <div class="form-row">
          <div class="form-element width-55pc">
            <div class="input-block">
              <label for="credit_other_teacher2_fullname" class="required">姓名</label>
              <div class="input-holder">
                <input type="text" name="tbName" id="credit_other_teacher2_fullname" required="true" value="<?= $userAllData->cdLife->tbName ?>" placeholder="请输入姓名" />
              </div>
            </div>
          </div>
          <div class="form-element width-45pc">
            <div class="select-block">
              <label for="credit_other_teacher2_sex" class="required">性别</label>
              <div class="input-holder">
                <select name="tbSex" id="credit_other_teacher2_sex" required="true">
                  <option <?php echo $userAllData->cdLife->tbSex == 1 ? 'selected="selected"' : '' ?> value="1">男</option>
                  <option <?php echo $userAllData->cdLife->tbSex == 2 ? 'selected="selected"' : '' ?> value="2">女</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-element width-100pc">
              <div class="input-block">
                <label for="credit_other_teacher2_mobile" class="required">手机</label>
                <div class="input-holder">
                  <input type="text" name="tbPhone" id="credit_other_teacher2_mobile" required="true" class="phone" value="<?= $userAllData->cdLife->tbPhone ?>" placeholder="请输入手机号" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-element width-100pc">
            <div class="input-block">
              <label for="credit_other_teacher2_job" class="required">职务</label>
              <div class="input-holder">
                <input type="text" name="tbDuty" id="credit_other_teacher2_job" required="true" value="<?= $userAllData->cdLife->tbDuty ?>" placeholder="请输入职务" />
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
