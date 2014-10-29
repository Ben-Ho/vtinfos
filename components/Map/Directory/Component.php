<?php
class Map_Directory_Component extends Kwc_Directories_Item_DirectoryNoAdmin_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['detail']['component'] = 'Map_Detail_Component';
        $ret['generators']['child']['component']['view'] = 'Map_ViewMap_Component';
        $ret['childModel'] = 'CongregationAddresses';
        $ret['componentName'] = trlStatic('Versammlungen Karte');
        $ret['cssClass'] = 'webStandard';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
