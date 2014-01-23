<?php
class Login_Component extends Kwc_User_Login_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['form'] = 'Login_Form_Component';
        $ret['flags']['resetMaster'] = true;
        $ret['assets']['dep'][] = 'KwfResponsiveEl';
        return $ret;
    }
}
