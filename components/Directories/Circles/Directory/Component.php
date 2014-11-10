<?php
class Directories_Circles_Directory_Component extends Kwc_Directories_Item_DirectoryNoAdmin_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['detail']['component'] = 'Directories_Circles_Detail_Component';
        $ret['generators']['detail']['model'] = 'Circles';
        $ret['generators']['child']['component']['view'] = 'Directories_Circles_View_Component';
        return $ret;
    }

    public function getSelect()
    {
        $ret = parent::getSelect();
        $ret->whereEquals('group_id', $this->getData()->parent->getRow()->id);
        return $ret;
    }
}
