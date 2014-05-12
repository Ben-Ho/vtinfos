<?php
class Directories_Congregations_Trl_Component extends Kwc_Directories_Item_Directory_Trl_Component
{
    public function getSelect()
    {
        $select = parent::getSelect();
        $select->order('name');
        return $select;
    }
}
