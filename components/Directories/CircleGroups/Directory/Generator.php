<?php
class Directories_CircleGroups_Directory_Generator extends Kwf_Component_Generator_Table
{
    protected function _formatSelect($parentData, $select)
    {
        $ret = parent::_formatSelect($parentData, $select);
        if (is_null($ret)) return null;
        $ret->order('name');
        return $ret;
    }
}