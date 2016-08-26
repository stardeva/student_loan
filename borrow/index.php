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
  <body class="personal-page borrow-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">贷款</span>
        <a href="../" class="nav link home text-right"><img src="../assets/images/home_icon_home.png" alt="" /></a>
      </nav>
    </header>
    <section class="process">
      <ul class="nav nav-tabs">
        <li class="flex-wrap-space active"><a data-toggle="tab" href="#fuli">福利货</a></li>
        <li class="flex-wrap-space"><a data-toggle="tab" href="#fuoli">活利货</a></li>
        <li class="flex-wrap-space"><a data-toggle="tab" href="#yueli">月利货</a></li>
      </ul>

      <div class="tab-content">
        <div id="fuli" class="tab-pane fade in active">
          <div class="loan-kind image">
            <div class="kind-head title flex-wrap">
              <span class="flex1">借款金额(元)</span>
              <span class="flex1">借款期限(天)</span>
            </div>
            
            <div class="kind-body flex-wrap">
              <div class="flex1">
                <select class="cost-selector form-control">
                  <option value="1">50</option>
                  <option value="2">100</option>
                  <option value="3">150</option>
                  <option value="4">200</option>
                  <option value="5">250</option>
                </select>
              </div>

              <div class="flex1">
                <select class="during-selector form-control">
                  <option value="1">0</option>
                  <option value="2">1</option>
                  <option value="3">2</option>
                  <option value="4">3</option>
                  <option value="5">4</option>
                </select>
              </div>          
            </div>
          </div>
        </div>

        <div id="huoli" class="tab-pane fade">
          <div class="loan-kind image">
            <div class="kind-head flex-wrap">
              <span class="flex1">借款金额(元)</span>
              <span class="flex1">借款期限(天)</span>
            </div>
            
            <div class="kind-body flex-wrap">
              <div class="flex1">
                <select class="cost-selector form-control">
                  <option value="1">50</option>
                  <option value="2">100</option>
                  <option value="3">150</option>
                  <option value="4">200</option>
                  <option value="5">250</option>
                </select>
              </div>

              <div class="flex1">
                <select class="during-selector form-control">
                  <option value="1">0</option>
                  <option value="2">1</option>
                  <option value="3">2</option>
                  <option value="4">3</option>
                  <option value="5">4</option>
                </select>
              </div>          
            </div>
          </div>
        </div>

        <div id="yueli" class="tab-pane fade">
          <div class="loan-kind image">
            <div class="kind-head flex-wrap">
              <span class="flex1">借款金额(元)</span>
              <span class="flex1">借款期限(天)</span>
            </div>
            
            <div class="kind-body flex-wrap">
              <div class="flex1">
                <select class="cost-selector form-control">
                  <option value="1">50</option>
                  <option value="2">100</option>
                  <option value="3">150</option>
                  <option value="4">200</option>
                  <option value="5">250</option>
                </select>
              </div>

              <div class="flex1">
                <select class="during-selector form-control">
                  <option value="1">0</option>
                  <option value="2">1</option>
                  <option value="3">2</option>
                  <option value="4">3</option>
                  <option value="5">4</option>
                </select>
              </div>          
            </div>
          </div>
        </div>        
      </div>
    </section>

    <section class="result">
      <span class="pull-left">计划还款</span>
      <div class="pull-right">
        <span class="loan-price">100.07</span>
        <span class="loan-time"> /1天</span>
      </div>
      <div class="clearfix"></div>
    </section>

    <section class="start-loan">
      <a class="loan-button" href="#" onclick="goCardPage()"></a>
      <div class="description">
        <div class="title">
          <p>产品及借款费用说明</p>          
        </div>

        <div class="content">
          <p>在学融宝平台完成一次（含） 以上借款且无逾期按时偿还方可申请本产品 （福利货结清记录不计入） : 按日计息， 0.66%。/日， 服务费5%，无逾期保证金3%: 借款期间内自由归还数额: 无逾期按时还款1次增加一颗信用豆（1 信用豆＝50元信用额度）， 信用豆可以累积: 发生1次逾期还款信用豆将归零， 需要重新累积: 任意两种产品不可同时申请。注: 学融宝前期推广期间内免服务费和无逾期保证金！</p>
        </div>
      </div>
    </section>

    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootbox.min.js"></script>

    <script src="../assets/js/main.js"></script>

  </body>
</html>