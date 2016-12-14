<?php
chdir(dirname(__FILE__));
require 'vendor/koala-framework/koala-framework/Kwf/Setup.php';
Kwf_Setup::setUp();
if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/manifest.json') {
    echo file_get_contents('./app/manifest.json');
    exit;
}
if (isset($_SERVER['HTTP_USER_AGENT'])
    && $_SERVER['HTTP_USER_AGENT'] == 'Microsoft Office Protocol Discovery'
) {
    echo '';
    exit;
}

Setup::dispatchKwc();
Kwf_Setup::dispatchMedia();

$front = Kwf_Controller_Front_Component::getInstance();

$response = $front->dispatch();
$response->sendResponse();
