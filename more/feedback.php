<?php
session_start();

if(isset($_COOKIE['uid']) && $_COOKIE['uid'] != '') {
  if(isset($_SESSION["initData"])) {
    $result = $_SESSION["initData"];
  }
} else {
  header("Location: ../../signup.php");
}
?>
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
  <body class="personal-page">
    <header class="header">
      <nav class="topnav">
        <a href="index.php" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title"><?php echo $_GET['title'] ?></span>
        <div class="nav"></div>
      </nav>
    </header>

    <section class="feedback-area">
      <form id="feedback_form" class="loan-form
      ">
        <div class="form-group edit-area">
          <textarea class="form-control" rows="10" name="feedback" id="feedback" placeholder="亲，您遇到什么问题啦？或者有什么好的建议给我们吗？欢迎提给我们！"></textarea>
        </div>
        
        <input type="button" class="btn btn-lg submit-btn" disabled value="提交反馈">  
      </form>      
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/js.cookie.js"></script>
    <script src="../assets/js/api.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootbox.min.js"></script>
    <script src="../assets/js/bootstrapValidator.min.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>