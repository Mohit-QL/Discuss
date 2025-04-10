<?php
require_once __DIR__ . '/vendor/autoload.php'; // Load Facebook SDK

$fb = new \Facebook\Facebook([
  'app_id' => '1585511952110987',
  'app_secret' => 'a88e9e8b8bb43aa0ae48799382dce616',
  'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$callbackUrl = 'http://localhost/Discuss/index.php?login=true';
$loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);
?>
