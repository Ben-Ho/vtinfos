<?php
namespace App\OAuth\Controller;

use Kwf_User_Model;
use Kwf_Component_Data_Root;
use OAuth2\HttpFoundationBridge\Request;
use OAuth2\HttpFoundationBridge\Response;
use OAuth2\Server;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthorizeController
{
    /** @var Kwf_User_Model $userModel */
    protected $userModel;
    /** @var Kwf_Component_Data_Root $rootCmp */
    protected $rootCmp;
    /** @var Server $oauthServer */
    protected $oauthServer;

    // http://vtinfos.benjamin.dev.vivid-planet.com/api/v1/oauth/authorize?redirect=http%3A%2F%2Fvtinfos.benjamin.dev.vivid-planet.com%2F&client_id=local&response_type=code&state=abc
    public function __construct(Kwf_User_Model $userModel, Kwf_Component_Data_Root $rootCmp, Server $server)
    {
        $this->userModel = $userModel;
        $this->rootCmp = $rootCmp;
        $this->oauthServer = $server;
    }

    public function handleAuthorizeAction(Request $request)
    {
        // TODO handle optional clear-session
        $userRow = $this->userModel->getAuthedUser();
        if (!$userRow) { // Redirect to Login_Component
            $cmp = $this->rootCmp->getComponentByClass('Login_Component');
            $params = array(
                'redirect' => $request->getRequestUri()
            );
            return new RedirectResponse($cmp->getAbsoluteUrl().'?'.http_build_query($params));
        }
        $response = new Response();
        return $this->oauthServer->handleAuthorizeRequest($request, $response, true, $userRow->id);
    }
}
