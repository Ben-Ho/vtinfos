<?php
namespace App\OAuth\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OAuth2\HttpFoundationBridge\Request;
use OAuth2\HttpFoundationBridge\Response;

class OpenIdUserInfoController extends Controller
{
    public function userinfoAction(Request $request)
    {
        return $this->get('oauth2.server')->handleUserInfoRequest($request, new Response());
    }
}
