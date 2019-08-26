<?php
namespace App\OAuth\Controller;

use OAuth2\HttpFoundationBridge\Request;
use OAuth2\HttpFoundationBridge\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthorizeController extends Controller
{
    public function handleAuthorizeAction(Request $request)
    {
        // TODO handle optional clear-session
        $userRow = $this->get('kwf.user.model')->getAuthedUser();
        if (!$userRow) { // Redirect to Login_Component
            $cmp = $this->get('app.service.rootCmp')->getComponentByClass('Login_Component');
            $params = array(
                'redirect' => $request->getRequestUri()
            );
            return new RedirectResponse($cmp->getAbsoluteUrl().'?'.http_build_query($params));
        }
        $response = new Response();
        return $this->get('oauth2.server')->handleAuthorizeRequest($request, $response, true, (string)$userRow->id);
    }
}
