<?php
class Login_Plugin_Component extends Kwf_Component_Plugin_LoginRedirect_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['validUserRoles'] = array('admin', 'superuser', 'talk-organiser');
        return $ret;
    }
}
