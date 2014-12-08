<?php
class Directories_Circles_Detail_Component extends Kwc_Directories_Item_Detail_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['congregations']
            = 'Directories_Circles_Detail_Congregations_Component';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
