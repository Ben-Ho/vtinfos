<?php
class Directories_Congregations_ViewPage_Component extends Kwc_Directories_List_ViewPage_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['plugins'] = array('Login_Plugin_Component');
        unset($ret['generators']['child']['component']['paging']);
        return $ret;
    }
}
