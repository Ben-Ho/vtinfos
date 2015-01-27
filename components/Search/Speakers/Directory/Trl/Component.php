<?php
class Search_Speakers_Directory_Trl_Component extends Kwc_Directories_Item_Directory_Trl_Component
{
    public function getSelect()
    {
        $ret = parent::getSelect();
        $ret->where(new Kwf_Model_Select_Expr_Sql('1 = 2'));
        return $ret;
    }
}
