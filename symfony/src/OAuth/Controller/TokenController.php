<?php
namespace App\OAuth\Controller;

use OAuth2\HttpFoundationBridge\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TokenController extends Controller
{
    public function tokenAction(Request $request)
    {
        return $this->get('oauth2.server')->handleTokenRequest($request, new Response());
    }
}
