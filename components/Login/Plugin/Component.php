<?php
class Login_Plugin_Component extends Kwf_Component_Plugin_LoginRedirect_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        return $ret;
    }
}
