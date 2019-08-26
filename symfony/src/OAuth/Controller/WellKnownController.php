<?php
namespace App\OAuth\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OAuth2\OpenID\Controller\AuthorizeController;
use OAuth2\HttpFoundationBridge\Request;
use OAuth2\HttpFoundationBridge\Response;

class WellKnownController extends Controller
{
    public function getConfigurationAction(Request $request)
    {
        $grantTypes = array();
        foreach ($this->get('oauth2.server')->getGrantTypes() as $grantType) {
            $grantTypes[] = $grantType->getQueryStringIdentifier();
        }
        $grantTypes [] = 'implicit'; // Implicit isn't an own Grant Type in Library but has to be exposed as one

        $reflection = new \ReflectionClass(get_class($this->get('oauth2.server')->getStorage('scope')));
        $scopesSupported = explode(' ', $reflection->getConstant('VALID_CLAIMS'));

        $baseUrl = $request->getSchemeAndHttpHost();
        return array(
            'issuer' => $this->get('oauth2.server')->getConfig('issuer'),
            'authorization_endpoint' => $baseUrl . $this->get('router')->getRouteCollection()->get('oauth-auth')->getPath(),
            'token_endpoint' => $baseUrl . $this->get('router')->getRouteCollection()->get('oauth-token')->getPath(),
            'jwks_uri' => $baseUrl . $this->get('router')->getRouteCollection()->get('openid-jwks')->getPath(),
            'userinfo_endpoint' => $baseUrl . $this->get('router')->getRouteCollection()->get('openid-userinfo')->getPath(),
            'response_types_supported' => array( // Copy from /vendor/bshaffer/oauth2-server-php/src/OAuth2/OpenID/Controller/AuthorizeController.php as getValidResponseTypes() is protected
                AuthorizeController::RESPONSE_TYPE_ACCESS_TOKEN,
                AuthorizeController::RESPONSE_TYPE_AUTHORIZATION_CODE,
                AuthorizeController::RESPONSE_TYPE_ID_TOKEN,
                AuthorizeController::RESPONSE_TYPE_ID_TOKEN_TOKEN,
                AuthorizeController::RESPONSE_TYPE_CODE_ID_TOKEN,
            ),
            'scopes_supported' => $scopesSupported,
            'grant_types_supported' => $grantTypes,
            'subject_types_supported' => array(
                'public'
            ),
            'id_token_signing_alg_values_supported' => array(
                'RS256'
            ),
            'claims_supported' => array(
                'iss',
                'sub',
                'aud',
                'iat',
                'exp',
                'auth_time',
                'email'
            ),
        );
    }

}
