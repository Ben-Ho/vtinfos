<?php
use OAuth2\HttpFoundationBridge\Request;

chdir(dirname(__FILE__));
require 'vendor/koala-framework/koala-framework/Kwf/Setup.php';
Kwf_Setup::setUp();

$request = Request::createFromGlobals();

$kernel = null;
$authHeaderValue = $request->headers('Authorization');
if ($authHeaderValue && strpos(strtolower($authHeaderValue), 'bearer') === 0) {
    $kernel = new AppKernel();
    $kernel->boot();
    $oauthServer = $kernel->getContainer()->get('oauth2.server');
    if (!$oauthServer->verifyResourceRequest($request)) {
        throw new Kwf_Exception_Unauthorized('Token not valid anymore');
    }
    $tokenData = $oauthServer->getAccessTokenData($request);
    $select = new Kwf_Model_Select();
    $select->whereId($tokenData['user_id']);
    $select->ignoreDeleted();
    $userRow = Kwf_Registry::get('userModel')->getRow($select);
    if (!$userRow || $userRow->deleted) throw new Kwf_Exception_Unauthorized('Token not valid anymore');
    Kwf_Registry::get('userModel')->setAuthedUser($userRow);
}

if (isset($_SERVER['REQUEST_URI']) && (
        (substr($_SERVER['REQUEST_URI'], 0, 5) == '/api/' && substr($_SERVER['REQUEST_URI'], 0, 12) != '/api/uploads')
        || substr($_SERVER['REQUEST_URI'], 0, 13) == '/kwf/symfony/'
    )) {
    $kernel = new AppKernel();
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);
    exit;
}

Kwf_Setup::dispatchKwc();
Kwf_Setup::dispatchMedia();

$front = Kwf_Controller_Front_Component::getInstance();

$response = $front->dispatch();
$response->sendResponse();
