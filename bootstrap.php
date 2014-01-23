<?php
chdir(dirname(__FILE__));
$include_path  = get_include_path();
$include_path .= PATH_SEPARATOR . 'controllers';
$include_path .= PATH_SEPARATOR . 'models';
$include_path .= PATH_SEPARATOR . 'components';
$include_path .= PATH_SEPARATOR . 'app';
set_include_path($include_path);
require_once '../kwf-lib/Kwf/Setup.php';
Kwf_Setup::setUp();
Kwf_Setup::dispatchKwc();
Kwf_Setup::dispatchMedia();

$front = Kwf_Controller_Front_Component::getInstance();

// acl ist in Acl und in config ist die aclClass gesetzt

$response = $front->dispatch();
$response->sendResponse();
