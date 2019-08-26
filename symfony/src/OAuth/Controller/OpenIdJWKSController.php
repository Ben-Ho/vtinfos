<?php
namespace App\OAuth\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OAuth2\HttpFoundationBridge\Request;
use OAuth2\HttpFoundationBridge\Response;

class OpenIdJWKSController extends Controller
{
    public function getJWTSetsAction(Request $request)
    {
        /* @var PublicKeyInterface $publicKeyStorage */
        $clientId = $request->get('client_id', null);
        if ($clientId) {
            $clientIds = array($clientId);
        } else  {
            $clientIds = $this->get('oauth2.server')->getStorage('client')->getAllClientPublicKeyClientIds();
        }

        $publicKeyStorage = $this->get('oauth2.server')->getStorage('public_key');

        $keys = array();
        foreach ($clientIds as $clientId) {
            $publicKey = openssl_get_publickey($publicKeyStorage->getPublicKey($clientId));
            if (!$publicKey) continue;
            $details = openssl_pkey_get_details($publicKey);
            $values = array(
                'kid' => $clientId,
                'e' => base64_encode($details['rsa']['e']),
                'n' => base64_encode($details['rsa']['n']),
                'kty' => 'RSA',
                'alg' => $publicKeyStorage->getEncryptionAlgorithm(),
            );
            if (!$clientId) unset($values['kid']);
            $keys[] = $values;
        }

        // Format see https://tools.ietf.org/html/draft-ietf-jose-json-web-key-35#appendix-A
        return array("keys" => $keys);
    }
}
