<?php
class Login_Component extends Kwc_User_Login_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['child']['component']['form'] = 'Login_Form_Component';
        $ret['flags']['resetMaster'] = true;
        return $ret;
    }
}
