<?php
require_once('../api/curl.php');
require_once('../api/functions.php');

$is_logged_in = checkUserLogin();

if($is_logged_in) {
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
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>学融宝 - 个人中心</title>

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
  <body class="personal-page personal-index-page">
    <header class="header">
      <nav class="topnav">
        <a href="../" class="nav text back"><img src="../assets/images/reg_black_left_arrow.png" alt="" /></a>
        <span class="nav text title">个人中心</span>
        <div class="nav"></div>
      </nav>
    </header>
    <section class="main no-padding">
      <a href="personal_my_info.php" class="personal-box">
        <div class="user-head">
          <img src="<?php echo isset($userAllData->user->portrait) && $userAllData->user->portrait != '' ? $userAllData->user->portrait : '../assets/images/user_head.png'; ?>" class="user-photo-preview" />
        </div>
        <div class="user-body">
          <div class="user-name"><?= $is_logged_in ? $userAllData->user->name : '您还没有登录哦~' ?></div>
          <div class="user-info">
            <?php if($is_logged_in): ?>
              <div class="user-credit">额度 <span><?= $userAllData->user->quota ?></span> 元</div>
              <div class="user-credit-beans">信用豆 <span><?= $userAllData->user->beans ?></span></div>
              <div class="user-total">总额度 <span><?= $userAllData->user->quotaTotal ?></span> 元</div>
            <?php else: ?>
              马上登录
            <?php endif; ?>
          </div>
        </div>
      </a>
      <div class="personal-info-list">
        <a href="<?php echo isset($userAllData->user->bank) && $userAllData->user->bank != '' ? 'personal_unbind_bank.php' : 'personal_bind_bank.php'; ?>" class="info-item right-arrow">
          <div class="item-icon"><img src="../assets/images/user_card.png" /></div>
          <div class="item-title">我的银行卡</div>
          <div class="item-desc"><?php if($is_logged_in) echo isset($userAllData->user->bank) && $userAllData->user->bank != '' ? $userAllData->user->bank.' (尾号'.substr($userAllData->user->bankCard, -4).')' : '绑定银行卡'; ?></div>
        </a>
        <a href="personal_coin_mall.php" class="info-item right-arrow">
          <div class="item-icon"><img src="../assets/images/user_coin.png" /></div>
          <div class="item-title">我的金币</div>
          <div class="item-desc"><?php if($is_logged_in) echo $userAllData->user->coins.'个'; ?></div>
        </a>
        <a href="personal_my_messages.php" class="info-item right-arrow">
          <div class="item-icon"><img src="../assets/images/user_msg.png" /></div>
          <div class="item-title">我的消息</div>
        </a>
        <a href="personal_my_history.php" class="info-item right-arrow">
          <div class="item-icon"><img src="../assets/images/user_history.png" /></div>
          <div class="item-title">历史记录</div>
        </a>
        <br />
        <a href="<?php if(!$is_logged_in) echo '../signup.php'; ?>" class="info-item right-arrow <?php if($is_logged_in) echo 'user-invite'; ?>">
          <div class="item-icon"><img src="../assets/images/user_invite.png" /></div>
          <div class="item-title">邀请好友</div>
        </a>
      </div>
    </section>
    <footer class="footer">
      <nav class="bottomnav">
        <a href="../" class="nav">
          <img src="../assets/images/footer_icon_home.png" alt="首页" />
          <span>首页</span>
        </a>
        <span class="bar"></span>
        <a href="javascript:;" class="nav">
          <img src="../assets/images/footer_icon_personal.png" alt="个人" />
          <span>个人</span>
        </a>
        <span class="bar"></span>
        <a href="../more" class="nav">
          <img src="../assets/images/footer_icon_more.png" alt="更多" />
          <span>更多</span>
        </a>
        <span class="bar"></span>
        <a href="personal_activities.php" class="nav">
          <img src="../assets/images/footer_icon_activity.png" alt="活动" />
          <span>活动</span>
        </a>
      </nav>
    </footer>
    <div class="bg-overlay hidden"></div>
    <div class="user-invite-apps">
      <a href="#" class="app weixin">
        <img src="../assets/images/icon_share_wx.png" />
        <span>微信</span>
      </a>
      <a href="#" class="app friend">
        <img src="../assets/images/icon_share_frd.png" />
        <span>朋友圈</span>
      </a>
      <a href="#" class="app sinaweibo">
        <img src="../assets/images/icon_share_sinaweibo.png" />
        <span>微博</span>
      </a>
      <a href="#" class="app qq">
        <img src="../assets/images/icon_share_qq.png" />
        <span>QQ</span>
      </a>
      <a href="#" class="app qzone">
        <img src="../assets/images/icon_share_qzone.png" />
        <span>QQ空间</span>
      </a>
      <div id="close_invite">取消</div>
    </div>

    <script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"></script>    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
