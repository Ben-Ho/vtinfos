<?php
class Directories_Circles_Detail_Congregations_Trl_Component extends Kwc_Directories_List_Trl_Component
{
    public function getSelect()
    {
        $ret = parent::getSelect();
        $ret->whereEquals('circle_id', $this->getData()->chained->parent->getRow()->id);
        return $ret;
    }
}
