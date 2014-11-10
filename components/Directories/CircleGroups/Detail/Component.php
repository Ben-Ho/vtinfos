<?php
class Directories_CircleGroups_Detail_Component extends Kwc_Directories_Item_Detail_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['circles']
            = 'Directories_Circles_Directory_Component';
        return $ret;
    }
}
