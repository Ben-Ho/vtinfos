<?php
class Login_Plugin_Component extends Kwf_Component_Plugin_LoginRedirect_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['validUserRoles'] = array('admin', 'superuser', 'talk-organiser');
        return $ret;
    }

    public function replaceOutput($renderer)
    {
        //Kopiert von Kwf_Component_Plugin_LoginRedirect_Component
        if (!$this->isLoggedIn()) {
            $url = $this->_getRedirectUrl();
            $component = Kwf_Component_Data_Root::getInstance()
                ->getComponentById($this->_componentId);
            // angepasst an unterstützte Sprachen
            if ($component->url != '/en' && $component->url != '/de') {
                $connector = '?';
                if (strstr($url, '?')) {
                    $connector = '&';
                }
                $url .= $connector.'redirect=' . urlencode($component->url);
            }
            header('Location: ' . $url);
            exit;
        }
        return false;
    }
}
