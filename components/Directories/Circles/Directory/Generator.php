<?php
class Directories_Circles_Directory_Generator extends Kwf_Component_Generator_Table
{
    protected function _formatSelect($parentData, $select)
    {
        $select = parent::_formatSelect($parentData, $select);
        $select->whereEquals('group_id', $parentData->parent->row->id);
        return $select;
    }
}
