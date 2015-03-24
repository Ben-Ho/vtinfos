<?php
class Setup
{
    public static function dispatchKwc()
    {
        $requestPath = Kwf_Setup::getRequestPath();
        if ($requestPath === false) return;
        $fullRequestPath = $requestPath;

        $data = null;
        $baseUrl = Kwf_Setup::getBaseUrl();
        if ($baseUrl) {
            if (substr($requestPath, 0, strlen($baseUrl)) != $baseUrl) {
                throw new Kwf_Exception_NotFound();
            }
            $requestPath = substr($requestPath, strlen($baseUrl));
        }
        $uri = substr($requestPath, 1);
        $i = strpos($uri, '/');
        if ($i) $uri = substr($uri, 0, $i);

        if ($uri == 'robots.txt') {
            Kwf_Media_Output::output(array(
                'contents' => "User-agent: *\nDisallow: /",
                'mimeType' => 'text/plain'
            ));
        }

        if ($uri == 'sitemap.xml') {
            throw new Kwf_Exception_NotFound();
        }
        Kwf_Setup::dispatchKwc();
    }
}
