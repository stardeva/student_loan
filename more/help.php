<?php
require_once('../api/curl.php');
require_once('../api/functions.php');
header('Access-Control-Allow-Origin: *');

$helpLink = $_SESSION['sys_info']->contract->help; 
$output = '<script>console.log('.json_encode($helpLink).')</script>';
echo $output;
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
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="personal-page help-page">
    <header class="header">
      <nav class="topnav">
        <a href="index.php" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">使用帮助</span>
        <div class="nav"></div>
      </nav>
    </header>

    <section class="contract-area">
      <!-- <canvas id='pdf_canvas'></canvas> -->
      <div id="helper_content"></div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/pdf.js"></script>
    <!-- <script src="../assets/js/compatibility.js"></script> -->
    <script src="../assets/js/main.js"></script>
    <script type="text/javascript">      
      //var pdf_url = "<?php echo $helpLink; ?>";
      //pdf_url = "../assets/1463534014_使用帮助.pdf";
      //getBinaryData(pdf_url, document.getElementById('helper_content'));
    </script> 
  </body>
</html>