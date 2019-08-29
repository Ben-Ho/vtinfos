<?php
namespace App\OAuth\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OAuth2\HttpFoundationBridge\Request;
use OAuth2\HttpFoundationBridge\Response;

class TokenController extends Controller
{
    public function tokenAction(Request $request)
    {
        return $this->get('oauth2.server')->handleTokenRequest($request, new Response());
    }
}