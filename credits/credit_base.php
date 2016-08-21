<?php
session_start();
if(isset($_SESSION['user_all_data']) && !empty($_SESSION['user_all_data'])) {
  $userAllData = $_SESSION['user_all_data'];
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

    <title>学融宝 - 信用额度 - 基本信息 - 1</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="../assets/css/swiper.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="credits-page credit-base-1-page form-page">
    <header class="header">
      <nav class="topnav">
        <a href="index.html" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">基本信息 ( 1/3 )</span>
        <a href="credit_base_2.html" class="nav text next">下一步</a>
      </nav>
    </header>
    <section class="main">
      <div class="info-box">
        注: 填写全都必填信才能点亮图标<br />手机号码我们不会主动拨打， 仅作为紧急联系使用
      </div>
      <?php print_r($userAllData); ?>
      <form enctype="multipart/form-data">
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="form-row">
                <div class="form-element width-55pc">
                  <div class="input-block">
                    <label for="credit_base1_name" class="required">姓名</label>
                    <div class="input-holder">
                      <input type="text" name="name" id="credit_base1_name" required="true" value="<?= $userAllData->cdBase->name ?>" />
                    </div>
                  </div>
                </div>
                <div class="form-element width-45pc">
                  <div class="select-block">
                    <label for="credit_base1_sex" class="required">性别</label>
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
                      <input type="text" name="pID" id="credit_base1_pid" required="true" value="1234567890" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base1_birthday" class="required">生日</label>
                    <div class="input-holder">
                      <input type="text" name="birthday" id="credit_base1_birthday" required="true" class="date datepicker" readonly="true" />
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
                      <div class="file-input">
                        <label class="required">正面照片上传</label>
                        <input type="file" name="credit_base1[positive_photo]" id="credit_base1_positive_photo" required="true" accept='image/*' class="file-upload" />
                        <img class="image-preview" />
                      </div>
                      <div class="file-input">
                        <label class="required">反面照片上传</label>
                        <input type="file" name="credit_base1[negative_photo]" id="credit_base1_negative_photo" required="true" accept='image/*' class="file-upload" />
                        <img class="image-preview" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-element width-100pc">
                  <div class="input-block">
                    <label for="credit_base1_reside_address" class="required">户口所在地</label>
                    <div class="input-holder">
                      <input type="text" name="credit_base1[reside_address]" id="credit_base1_reside_address" required="true" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              hello
            </div>
          </div>
        </div>
        
      </form>
    </section>

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="../assets/js/swiper.min.js"></script>

    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
