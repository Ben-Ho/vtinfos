<?php
class User_ChangePassword_Component extends Kwc_User_ChangePassword_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('User').'.'.trlStatic('Passwort ändern');
        $ret['generators']['child']['component']['form'] = 'Kwc_User_ChangePassword_Form_Component';
        return $ret;
    }
}
