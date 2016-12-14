<?php
class Directories_Circles_View_Component extends Kwc_Directories_List_View_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        unset($ret['generators']['child']['component']['paging']);
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
