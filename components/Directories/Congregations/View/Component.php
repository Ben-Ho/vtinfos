<?php
class Directories_Congregations_View_Component extends Kwc_Directories_List_ViewPage_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        unset($ret['generators']['child']['component']['paging']);
        $ret['plugins'] = array('Login_Plugin_Component');
        //TODO viewcach wieder ein, cache löschen richtig machen
        $ret['viewCache'] = false;
        return $ret;
    }
}
