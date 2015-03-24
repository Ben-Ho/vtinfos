<?php
chdir(dirname(__FILE__));
require_once 'kwf-lib/Kwf/Setup.php';
Kwf_Setup::setUp();

setcookie('feAutologin', '', time() - 3600, '/', null, Kwf_Util_Https::supportsHttps(), true);
setcookie('hasFeAutologin', '', time() - 3600, '/', null, false, true);

Setup::dispatchKwc();
Kwf_Setup::dispatchMedia();

$front = Kwf_Controller_Front_Component::getInstance();

$response = $front->dispatch();
$response->sendResponse();
