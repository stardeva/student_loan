<?php
$API_HOST = 'http://api.wazxb.com/';

$API_ENDPOINTS = array(
  'ADDRESS_SYS_VCODE' =>    'sys/vcode',
  'ADDRESS_SYS_INIT' =>     'sys/init',
  'ADDRESS_U_REG' =>        'u/reg',
  'ADDRESS_U_LOGIN' =>      'u/login',
  'ADDRESS_U_BANK' =>       'u/bank',
  'ADDRESS_U_UNBANK' =>     'u/unbank',
  'ADDRESS_CD_UPHOME' =>    'cd/uphome',
  'ADDRESS_CD_LIFE' =>      'cd/uplife',
  'ADDRESS_CD_BASE' =>      'cd/upbase',
  'ADDRESS_CD_INFO' =>      'cd/info',
  'ADDRESS_CD_UPSCHOOL' =>  'cd/upschool',
  'ADDRESS_U_MSG' =>        'u/msg',
  'ADDRESS_U_FEEDBACK' =>   'u/feedback',
  'ADDRESS_U_UPPORTRAIT' => 'u/upportrait',
  'ADDRESS_U_GESTURE' =>    'u/gesture',
  'ADDRESS_U_BOOK' =>       'u/book',
  'ADDRESS_U_POSITION' =>       'u/position',

  'ADDRESS_LN_CALCULATOR' => 'ln/calculator',
  'ADDRESS_LN_APPLY' =>      'ln/apply',
  'ADDRESS_LN_PROD' =>       'ln/prod',
  'ADDRESS_LN_RETURN' =>     'ln/return',
  'ADDRESS_LN_HISTORY' =>    'ln/history',
  'ADDRESS_LN_EVALUATE' =>   'ln/evaluate',
  'ADDRESS_LN_SEVALUATE' =>  'ln/sevaluate',

  'ADDRESS_MALL_LIST' => 'mall/list',
  'ADDRESS_MALL_BUY' =>  'mall/buy',

  'ADDRESS_SYS_SRED' => 'app/sred',
  'ADDRESS_SYS_RED' =>  'app/red',

  'ADDRESS_SYS_SIGN' =>  'app/sign',
  'ADDRESS_SYS_SSIGN' => 'app/ssign',

  'ADDRESS_PW_FIND' =>   'pw/find',
  'ADDRESS_PW_MODIFY' => 'pw/modify',
  'ADDRESS_PW_VERIFY' => 'pw/verify',
  'ADDRESS_SE_SCHOOL' => 'se/school',

  'ADDRESS_UP_IMAGE' => 'sys/uppic'
);

function httpPost($url, $params) {
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

  $output = curl_exec($ch);
  curl_close($ch);
  return $output;
}

function httpGet($url, $params) {
  $url = $url.'?'.http_build_query($params, '', '&');    
  $ch = curl_init();  
  curl_setopt($ch, CURLOPT_URL, $url);  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      
  $response = curl_exec($ch);
  curl_close($ch);
  return $response;
}

$BANK_LIST = array(
  "中国工商银行",
  "中国农业银行",
  "中国银行",
  "中国建设银行",
  "交通银行",
  "中国邮政储蓄银行",
  "招商银行",
  "中信银行",
  "中国光大银行",
  "华夏银行",
  "上海浦东发展银行",
  "中国民生银行",
  "广发银行",
  "兴业银行",
  "平安银行",
  "浙商银行",
  "渤海银行",
  "东亚银行",
  "大华银行",
  "韩亚银行",
  "吉林银行",
  "盛京银行",
  "锦州银行",
  "葫芦岛银行",
  "大连银行",
  "鞍山银行",
  "抚顺银行",
  "丹东银行",
  "营口银行",
  "盘锦银行",
  "阜新银行",
  "辽阳银行",
  "铁岭银行",
  "朝阳银行",
  "哈尔滨银行",
  "沈阳农商银行"
  );

$DEGREE_LIST = array(
  "在读本科",
  "在读研究生",
  "在读博士"
  );

$USER_TEMP = array(
  'uid' => '',
  'deviceId' => '00000000000000008:00:27:44:04:bb323ec7466101f399',
  'deviceOs' => 'Android',
  'deviceType' => 'Google Nexus S - 4.1.1 - API 16 - 480x800',
  'deviceOp' => '4.1.1',
  'version' => '1.0.1',
  'deviceToken' => ''
);

$FILE_UPLOAD_URL = 'http://zxb-pic.img-cn-beijing.aliyuncs.com/';

?>
