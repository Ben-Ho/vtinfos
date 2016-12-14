<?php
class Map_Directory_Component extends Kwc_Directories_Item_DirectoryNoAdmin_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['detail']['component'] = 'Map_Detail_Component';
        $ret['generators']['child']['component']['view'] = 'Map_ViewMap_Component';
        $ret['childModel'] = 'Map_Directory_AddressesModel';
        $ret['componentName'] = trlStatic('Versammlungen Karte');
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
