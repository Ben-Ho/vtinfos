<?php
class User_Edit_Component extends Kwc_User_Edit_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('User Bearbeiten');
        return $ret;
    }
}
