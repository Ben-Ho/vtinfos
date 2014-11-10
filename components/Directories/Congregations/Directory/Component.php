<?php
class Directories_Congregations_Directory_Component extends Kwc_Directories_ItemPage_Directory_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['partialId'] = '';
        $ret['generators']['detail']['component'] = 'Directories_Congregations_Detail_Component';
        $ret['generators']['detail']['model'] = 'Congregations';
        $ret['generators']['child']['component']['view'] = 'Directories_Congregations_View_Component';
        return $ret;
    }

    public function getSelect()
    {
        $ret = parent::getSelect();
        $ret->whereEquals('circle_id', $this->getData()->parent->getRow()->id);
        return $ret;
    }
}
