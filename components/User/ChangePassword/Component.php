<?php
class User_ChangePassword_Component extends Kwc_User_ChangePassword_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('User').'.'.trlStatic('Passwort ändern');
        $ret['plugins'] = array('Login_Plugin_Component');
        $ret['generators']['child']['component']['form'] = 'Kwc_User_ChangePassword_Form_Component';
        return $ret;
    }
}
