<?php
class Directories_Circles_Directory_Component extends Kwc_Directories_Item_DirectoryNoAdmin_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['detail']['component'] = 'Directories_Circles_Detail_Component';
        $ret['generators']['detail']['model'] = 'Circles';
        $ret['generators']['detail']['class'] = 'Directories_Circles_Directory_Generator';
        $ret['generators']['child']['component']['view'] = 'Directories_Circles_View_Component';
        $ret['extConfig'] = 'Kwf_Component_Abstract_ExtConfig_None';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getSelect()
    {
        $ret = parent::getSelect();
        $ret->order('name');
        return $ret;
    }
}
