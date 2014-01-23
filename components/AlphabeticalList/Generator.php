<?php
class AlphabeticalList_Generator extends Kwf_Component_Generator_Page_Table
{
    protected function _formatSelect($parentData, $select)
    {
        $select = parent::_formatSelect($parentData, $select);
        if (is_null($select) || is_null($parentData)) return null;
        $select->order('name');
        return $select;
    }

}
