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

    <title>学融宝 - 信用额度 - 基本信息</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="../assets/css/swiper.min.css" rel="stylesheet">
    <link href="../assets/css/select2.min.css" rel="stylesheet">
    <link href="../assets/css/select2-flat.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="credits-page credit-base-page form-page">
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">基本信息 ( 1/3 )</span>
        <a href="" class="nav text next">下一步</a>
      </nav>
    </header>
    <section class="main">
      <div class="info-box">
        注: 填写全都必填信才能点亮图标<br />手机号码我们不会主动拨打， 仅作为紧急联系使用
      </div>
      <form action="../api/actions.php" id="credit_base" name="credit_base" method="post">
        <input type="hidden" name="uId" value="<?= $uId ?>" />
        <input type="hidden" name="page" value="credit_base" />
        <input type="hidden" name="backurl" value="../credits/credit_base.php" />
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <!-- Credit Base Step 1 -->
            <div class="swiper-slide">
              <div class="form-row">
                <div class="form-element width-55pc">
                  <div class="input-block">
                    <label for="credit_base1_name" class="required">姓名</label>
                    <div class="input-holder">
                      <input type="text" name="name" id="credit_base1_name" required="true" value="<?= $userAllData->cdBase->name ?>" placeholder="请输入姓名" />
                    </div>
                  </div>
                </div>
                <div class="form-element width-45pc">
                  <div class="select-block">
                    <label for="credit_base1_sex" class="required" placeholder="请输入性别">性别</label>
                    <div class="input-holder">
                      <select name="sex" id="credit_base1_sex" required="true">
                        <option <?php echo $userAllData->cdBase->sex == 1 ? 'selected="selected"' : '' ?> value="1">男</option>
                        <option <?php echo $userAllData->cdBase->sex == 2 ? 'selected="selected"' : '' ?> value="2">女</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base1_pid" class="required">身份证号</label>
                    <div class="input-holder">
                      <input type="number" name="pID" id="credit_base1_pid" required="true" value="<?= $userAllData->cdBase->pID ?>" placeholder="请输入身份证号" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base1_birthday" class="required">生日</label>
                    <div class="input-holder">
                      <input type="text" name="birthday" id="credit_base1_birthday" required="true" class="date datepicker" readonly="true" value="<?= $userAllData->cdBase->birthday ?>" placeholder="请输入出生日期" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="file-block">
                    <div class="input-label">
                      <label for="credit_base1_id_card_photo" class="required">身份证照片</label>
                    </div>
                    <div class="input-holder">
                      <div class="file-input" style="<?php echo isset($userAllData->cdBase->pIDFPic) && $userAllData->cdBase->pIDFPic !='' ? 'background-position: -9999px;' : ''; ?>">
                        <label class="required <?php echo isset($userAllData->cdBase->pIDFPic) && $userAllData->cdBase->pIDFPic !='' ? 'hidden' : ''; ?>">正面照片上传</label>
                        <input type="file" required="true" accept='image/*' class="file-upload" />
                        <img class="image-preview <?php echo isset($userAllData->cdBase->pIDFPic) && $userAllData->cdBase->pIDFPic !='' ? '' : 'hidden'; ?>" src="<?php if(isset($userAllData->cdBase->pIDFPic) && $userAllData->cdBase->pIDFPic != '') echo $userAllData->cdBase->pIDFPic; ?>" />
                        <input type="hidden" name="pIDFPic" class="file-key" />
                      </div>
                      <div class="file-input" style="<?php echo isset($userAllData->cdBase->pIDBPic) && $userAllData->cdBase->pIDBPic !='' ? 'background-position: -9999px;' : ''; ?>">
                        <label class="required <?php echo isset($userAllData->cdBase->pIDBPic) && $userAllData->cdBase->pIDBPic !='' ? 'hidden' : ''; ?>">反面照片上传</label>
                        <input type="file" required="true" accept='image/*' class="file-upload" />
                        <img class="image-preview <?php echo isset($userAllData->cdBase->pIDBPic) && $userAllData->cdBase->pIDBPic !='' ? '' : 'hidden'; ?>" src="<?php if(isset($userAllData->cdBase->pIDBPic) && $userAllData->cdBase->pIDBPic != '') echo $userAllData->cdBase->pIDBPic; ?>" />
                        <input type="hidden" name="pIDBPic" class="file-key" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base1_place" class="required">户口所在地</label>
                    <div class="input-holder">
                      <input type="text" name="place" id="credit_base1_place" required="true" value="<?= $userAllData->cdBase->place ?>" placeholder="x省x市(县)x区x乡(镇)" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Credit Base Step 2 -->
            <div class="swiper-slide">
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="select-block">
                    <label for="credit_base2_university" class="required">学校</label>
                    <div class="input-holder">
                      <select name="university" id="credit_base2_university" required="true">
                        <?php if($userAllData->cdBase->university == ''): ?>
                          <option selected="selected" value="<?= $userAllData->cdBase->university ?>"><?= $userAllData->cdBase->university ?></option>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base2_college" class="required">学院</label>
                    <div class="input-holder">
                      <input type="text" name="college" id="credit_base2_college" required="true" value="<?= $userAllData->cdBase->college ?>" placeholder="请输入学院名称" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base2_major" class="required">专业</label>
                    <div class="input-holder">
                      <input type="text" name="major" id="credit_base2_major" required="true" value="<?= $userAllData->cdBase->major ?>" placeholder="请输入专业名称" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="select-block">
                    <label for="credit_base2_enrollment" class="required">学历</label>
                    <div class="input-holder">
                      <select name="education" id="credit_base2_education" required="true" placeholder="请输入学历信息">
                        <?php foreach($DEGREE_LIST as $degree): ?>
                          <option <?php if(intval($userAllData->cdBase->education) == $degree) echo 'selected="selected"' ?> value="<?=$degree ?>"><?=$degree ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="select-block">
                    <label for="credit_base2_enrollment" class="required">人学时间</label>
                    <div class="input-holder">
                      <select name="enrollment" id="credit_base2_enrollment" required="true" placeholder="请输入入学时间">
                        <?php for($enrollment_year = 2000; $enrollment_year <= intval(date('Y')); $enrollment_year++): ?>
                          <option <?php if(intval($userAllData->cdBase->enrollment) == $enrollment_year) echo 'selected="selected"' ?> value="<?=$enrollment_year ?>年"><?=$enrollment_year ?>年</option>
                        <?php endfor; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base2_student_id" class="required">学号</label>
                    <div class="input-holder">
                      <input type="text" name="sID" id="credit_base2_student_id" required="true" value="<?= $userAllData->cdBase->sID ?>" placeholder="请输入学号信息" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base2_grade" class="required">班级</label>
                    <div class="input-holder">
                      <input type="text" name="grade" id="credit_base2_grade" required="true" value="<?= $userAllData->cdBase->grade ?>" placeholder="请输入班级" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base2_dorm" class="required">寝室地址</label>
                    <div class="input-holder">
                      <input type="text" name="dorm" id="credit_base2_dorm" required="true" value="<?= $userAllData->cdBase->dorm ?>" placeholder="请具体到x栋x号房间" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="file-block">
                    <div class="input-label">
                      <label for="credit_base2_student_id_photo" class="required">学生证照片</label>
                    </div>
                    <div class="input-holder">
                      <div class="file-input" style="<?php echo isset($userAllData->cdBase->sIDAPic) && $userAllData->cdBase->sIDAPic !='' ? 'background-position: -9999px;' : ''; ?>">
                        <label class="required <?php echo isset($userAllData->cdBase->sIDAPic) && $userAllData->cdBase->sIDAPic !='' ? 'hidden' : ''; ?>">封面照片上传</label>
                        <input type="file" required="true" accept='image/*' class="file-upload" />
                        <img class="image-preview <?php echo isset($userAllData->cdBase->sIDAPic) && $userAllData->cdBase->sIDAPic !='' ? '' : 'hidden'; ?>" src="<?php if(isset($userAllData->cdBase->sIDAPic) && $userAllData->cdBase->sIDAPic != '') echo $userAllData->cdBase->sIDAPic; ?>" />
                        <input type="hidden" name="sIDAPic" class="file-key" />
                      </div>
                      <div class="file-input" style="<?php echo isset($userAllData->cdBase->sIDBPic) && $userAllData->cdBase->sIDBPic !='' ? 'background-position: -9999px;' : ''; ?>">
                        <label class="required <?php echo isset($userAllData->cdBase->sIDBPic) && $userAllData->cdBase->sIDBPic !='' ? 'hidden' : ''; ?>">内容照片上传</label>
                        <input type="file" required="true" accept='image/*' class="file-upload" />
                        <img class="image-preview <?php echo isset($userAllData->cdBase->sIDBPic) && $userAllData->cdBase->sIDBPic !='' ? '' : 'hidden'; ?>" src="<?php if(isset($userAllData->cdBase->sIDBPic) && $userAllData->cdBase->sIDBPic != '') echo $userAllData->cdBase->sIDBPic; ?>" />
                        <input type="hidden" name="sIDBPic" class="file-key" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="file-block">
                    <div class="input-label">
                      <label for="credit_base2_card_photo" class="required">一卡通照片</label>
                    </div>
                    <div class="input-holder">
                      <div class="file-input" style="<?php echo isset($userAllData->cdBase->sCardFPic) && $userAllData->cdBase->sCardFPic !='' ? 'background-position: -9999px;' : ''; ?>">
                        <label class="required <?php echo isset($userAllData->cdBase->sCardFPic) && $userAllData->cdBase->sCardFPic !='' ? 'hidden' : ''; ?>">正面照片上传</label>
                        <input type="file" required="true" accept='image/*' class="file-upload" />
                        <img class="image-preview <?php echo isset($userAllData->cdBase->sCardFPic) && $userAllData->cdBase->sCardFPic !='' ? '' : 'hidden'; ?>" src="<?php if(isset($userAllData->cdBase->sCardFPic) && $userAllData->cdBase->sCardFPic != '') echo $userAllData->cdBase->sCardFPic; ?>" />
                        <input type="hidden" name="sCardFPic" class="file-key" />
                      </div>
                      <div class="file-input" style="<?php echo isset($userAllData->cdBase->sCardBPic) && $userAllData->cdBase->sCardBPic !='' ? 'background-position: -9999px;' : ''; ?>">
                        <label class="required <?php echo isset($userAllData->cdBase->sCardBPic) && $userAllData->cdBase->sCardBPic !='' ? 'hidden' : ''; ?>">背面照片上传</label>
                        <input type="file" required="true" accept='image/*' class="file-upload" />
                        <img class="image-preview <?php echo isset($userAllData->cdBase->sCardBPic) && $userAllData->cdBase->sCardBPic !='' ? '' : 'hidden'; ?>" src="<?php if(isset($userAllData->cdBase->sCardBPic) && $userAllData->cdBase->sCardBPic != '') echo $userAllData->cdBase->sCardBPic; ?>" />
                        <input type="hidden" name="sCardBPic" class="file-key" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="file-block">
                    <div class="input-label">
                      <label for="credit_base2_xxw_photo" class="required">学信网</label>
                      <span>点击查看上传方法</span>
                    </div>
                    <div class="input-holder">
                      <div class="file-input" style="<?php echo isset($userAllData->cdBase->authenPic) && $userAllData->cdBase->authenPic !='' ? 'background-position: -9999px;' : ''; ?>">
                        <label class="required <?php echo isset($userAllData->cdBase->authenPic) && $userAllData->cdBase->authenPic !='' ? 'hidden' : ''; ?>">学籍截图</label>
                        <input type="file" required="true" accept='image/*' class="file-upload" />
                        <img class="image-preview <?php echo isset($userAllData->cdBase->authenPic) && $userAllData->cdBase->authenPic !='' ? '' : 'hidden'; ?>" src="<?php if(isset($userAllData->cdBase->authenPic) && $userAllData->cdBase->authenPic != '') echo $userAllData->cdBase->authenPic; ?>" />
                        <input type="hidden" name="authenPic" class="file-key" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Credit Base Step 3 -->
            <div class="swiper-slide">
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base3_mail" class="required">邮箱</label>
                    <div class="input-holder">
                      <input type="text" name="mail" id="credit_base3_mail" required="true" class="email" value="<?= $userAllData->cdBase->mail ?>" placeholder="请输入邮箱" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base3_weixin" class="required">微信</label>
                    <div class="input-holder">
                      <input type="text" name="weixin" id="credit_base3_weixin" required="true" class="weixin" value="<?= $userAllData->cdBase->weixin ?>" placeholder="请写微信账号" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base3_qq" class="required">QQ</label>
                    <div class="input-holder">
                      <input type="text" name="qq" id="credit_base3_qq" required="true" class="qq" value="<?= $userAllData->cdBase->qq ?>" placeholder=">请写QQ账号" />
                    </div>
                  </div>
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
    <script type="text/javascript" src="../assets/js/swiper.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.popupoverlay.js"></script>
    <script type="text/javascript" src="../assets/js/select2.min.js"></script>

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
