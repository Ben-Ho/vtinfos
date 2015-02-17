<?php
class Directories_Circles_Directory_Generator extends Kwf_Component_Generator_Table
{
    protected function _formatSelect($parentData, $select)
    {
        $select = parent::_formatSelect($parentData, $select);
        if ($parentData)
            $select->whereEquals('group_id', $parentData->parent->row->id);
        return $select;
    }

    protected function _getParentDataByRow($row, $select)
    {
        $component = Kwf_Component_Data_Root::getInstance()
            ->getComponentByClass('Directories_CircleGroups_Directory_Component');
        return $component->getChildComponent('-'.$row->group_id);
    }
}
