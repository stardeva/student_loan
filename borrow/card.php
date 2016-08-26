<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrapValidator.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header class="header">
      <nav class="topnav">
        <a href="./" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">绑定银行卡</span>
        <a href="../" class="nav link home text-right"><img src="../assets/images/home_icon_home.png" alt="" /></a>
      </nav>
    </header>

    <section class="bank-card main-loan-area">
      <form id="bank_card_form" class="form-horizontal loan-form main-wrap">
        <div class="back-card-title">
          <label>请绑定本人的银行卡</label>
        </div>
        <div class="form-group">
          <label class="col-xs-5 cols control-label">银行卡号<span class="reqire-icon"> *</span></label>
          <div class="col-xs-7 cols">
              <input class="form-control input-lg" name="card" type="text" size="35" placeholder="仅支持储蓄卡">
          </div>
          </input>
        </div>

        <div class="form-group">
          <label class="col-xs-5 cols control-label">银行<span class="reqire-icon"> *</span></label>
          <div class="col-xs-7 cols">
              <input class="form-control input-lg" id="bank_name" name="bank" type="text" size="35" placeholder="请选择"></input>
              <div class="arrow image"></div>
          </div>
          </input>
        </div>

        <div class="form-group">
          <label class="col-xs-5 cols control-label">开户行<span class="reqire-icon"> *</span></label>
          <div class="col-xs-7 cols">
              <input class="form-control input-lg" name="number" type="text" size="35" placeholder="例如xx支行"></input>
          </div>
          </input>
        </div>

        <a class="btn btn-lg btn-default submit-button" type="submit" disabled onclick="completeCard()">确定</a>
      </form>
    </section>
    
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/js.cookie.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootbox.min.js"></script>
    <script src="../assets/js/bootstrapValidator.min.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>
</html>