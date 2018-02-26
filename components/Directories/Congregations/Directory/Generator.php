<?php
class Directories_Congregations_Directory_Generator extends Kwf_Component_Generator_Page_Table
{
    protected function _formatSelect($parentData, $select)
    {
        $ret = parent::_formatSelect($parentData, $select);
        if (is_null($ret)) return null;
        $ret->order('name');
        return $ret;
    }
}
