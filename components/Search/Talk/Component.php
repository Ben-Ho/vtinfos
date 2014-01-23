<?php
class Search_Talk_Component extends Kwc_Directories_ItemPage_Directory_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['detail']['model'] = 'Speakers';
        $ret['generators']['child']['component']['view'] = 'Search_Talk_ViewPage_Component';
        $ret['extConfig'] = 'Kwf_Component_Abstract_ExtConfig_None';
        $ret['componentName'] = trlStatic('Suche nach Vortrag');
        return $ret;
    }
}
