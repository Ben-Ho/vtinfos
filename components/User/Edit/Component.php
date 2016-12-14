<?php
class User_Edit_Component extends Kwc_User_Edit_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('User').'.'.trlStatic('Bearbeiten');
        $ret['generators']['child']['component']['form'] = 'User_Edit_Form_Component';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
