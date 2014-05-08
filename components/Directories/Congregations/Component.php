<?php
class Directories_Congregations_Component extends Kwc_Directories_ItemPage_Directory_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['detail']['model'] = 'Congregations';
//         $ret['generators']['child']['component']['view'] = 'Directories_Congregations_ViewPage_Component';
        $ret['generators']['detail']['component'] = 'Directories_Congregations_Detail_Component';
        $ret['generators']['detail']['dbIdShortcut'] = 'congregation_';
        $ret['extConfig'] = 'Kwf_Component_Abstract_ExtConfig_None';
        $ret['componentName'] = trlStatic('Versammlungen A-Z2');
        $ret['useDirectorySelect'] = false;
        return $ret;
    }

    public function getSelect()
    {
        $ret = parent::getSelect();
        $ret->order('name');
        return $ret;
    }
}
