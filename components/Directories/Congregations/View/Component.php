<?php
class Directories_Congregations_View_Component extends Kwc_Directories_List_ViewPage_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        unset($ret['generators']['child']['component']['paging']);
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
