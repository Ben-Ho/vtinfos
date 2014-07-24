<?php
class User_Edit_Component extends Kwc_User_Edit_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('User').'.'.trlStatic('Bearbeiten');
        $ret['generators']['child']['component']['form'] = 'User_Edit_Form_Component';
        return $ret;
    }
}
