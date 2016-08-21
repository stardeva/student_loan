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
  'ADDRESS_SE_SCHOOL' => 'se/school'
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
?>