<?php
class Directories_Congregations_Directory_Component extends Kwc_Directories_ItemPage_Directory_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('Versammlungen').'.'.trlStatic('Alphabetisch');
        $ret['generators']['detail']['class'] = 'Directories_Congregations_Directory_Generator';
        $ret['generators']['detail']['component'] = 'Directories_Congregations_Detail_Component';
        $ret['generators']['detail']['model'] = 'Congregations';
        $ret['generators']['child']['component']['view'] = 'Directories_Congregations_View_Component';
        $ret['generators']['detail']['dbIdShortcut'] = 'congregations_';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
