<?php
class Circles_Circle_Generator extends Kwf_Component_Generator_Page_Table
{
    protected function _formatSelect($parentData, $select)
    {
        $select = parent::_formatSelect($parentData, $select);
        if (is_null($select) || is_null($parentData)) return null;
        $select->whereEquals('circle_id', $parentData->getRow()->id);
        return $select;
    }

}
