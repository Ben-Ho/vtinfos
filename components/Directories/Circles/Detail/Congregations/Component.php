<?php
class Directories_Circles_Detail_Congregations_Component extends Kwc_Directories_List_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['view'] = 'Directories_Congregations_View_Component';
        $ret['useDirectorySelect'] = false;
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    protected function _getItemDirectory()
    {
        return Kwf_Component_Data_Root::getInstance()
            ->getComponentByClass('Directories_Congregations_Directory_Component');
    }

    public static function getItemDirectoryClasses($componentClass)
    {
        return array('Directories_Congregations_Directory_Component');
    }

    public function getSelect()
    {
        $ret = parent::getSelect();
        $ret->whereEquals('circle_id', $this->getData()->parent->getRow()->id);
        $ret->order('name');
        return $ret;
    }
}
