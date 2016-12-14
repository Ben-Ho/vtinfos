<?php
class Search_Speakers_Directory_Component extends Kwc_Directories_ItemPage_Directory_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['detail']['component'] = 'Search_Speakers_Detail_Component';
        $ret['generators']['detail']['model'] = 'Speakers';
        $ret['generators']['child']['component']['view'] = 'Search_Speakers_View_Component';
        $ret['extConfig'] = 'Kwf_Component_Abstract_ExtConfig_None';
        $ret['componentName'] = trlStatic('Suche nach Vortrag');
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getSelect()
    {
        $ret = parent::getSelect();
        $ret->where(new Kwf_Model_Select_Expr_Sql('1 = 2'));
        return $ret;
    }
}
