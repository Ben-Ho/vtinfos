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

// Calling Symfony
use Symfony\Component\HttpFoundation\Request; //nicht Symfony\Component\HttpFoundation\Request wegen fixAuthHeader
if (isset($_SERVER['REQUEST_URI']) && (
        (substr($_SERVER['REQUEST_URI'], 0, 5) == '/api/' && substr($_SERVER['REQUEST_URI'], 0, 12) != '/api/uploads')
        || substr($_SERVER['REQUEST_URI'], 0, 13) == '/kwf/symfony/'
    )) {
    $request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
    $kernel = new AppKernel();
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);
    exit;
}

Setup::dispatchKwc();
Kwf_Setup::dispatchMedia();

$front = Kwf_Controller_Front_Component::getInstance();

$response = $front->dispatch();
$response->sendResponse();
