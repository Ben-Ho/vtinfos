<?php
class Search_Speakers_View_SearchForm_Component extends Kwc_Form_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('Suchfomular (Vortrag)');
        $ret['generators']['child']['component']['success'] = false;
        $ret['useAjaxRequest'] = false;
        $ret['method'] = 'get';
        $ret['placeholder']['submitButton'] = trlKwfStatic('Search');
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
