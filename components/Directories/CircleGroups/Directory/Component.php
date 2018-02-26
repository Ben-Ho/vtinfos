<?php
class Directories_CircleGroups_Directory_Component extends Kwc_Directories_Item_DirectoryNoAdmin_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('Versammlungen').'.'.trlStatic('Nach Kreisen');
        $ret['generators']['detail']['component'] = 'Directories_CircleGroups_Detail_Component';
        $ret['generators']['detail']['class'] = 'Directories_CircleGroups_Directory_Generator';
        $ret['generators']['detail']['model'] = 'CircleGroups';
        $ret['generators']['child']['component']['view'] = 'Directories_CircleGroups_View_Component';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
