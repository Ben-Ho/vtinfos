<?php
class Directories_Congregations_Generator extends Kwf_Component_Generator_Page_Table
{
    protected function _getParentDataByRow($row, $select)
    {
        $component = Kwf_Component_Data_Root::getInstance()->getComponentByClass('Root_Master_Component');
        return $component;
    }
}
