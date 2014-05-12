<?php
class Directories_Congregations_Component extends Kwc_Directories_ItemPage_Directory_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['detail']['model'] = 'Congregations';
        $ret['generators']['detail']['class'] = 'Directories_Congregations_Generator';
        $ret['generators']['detail']['component'] = 'Directories_Congregations_Detail_Component';
        $ret['extConfig'] = 'Kwf_Component_Abstract_ExtConfig_None';
        $ret['componentName'] = trlStatic('Versammlungen A-Z');
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
