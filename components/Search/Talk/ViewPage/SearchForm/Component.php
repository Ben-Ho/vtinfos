<?php
class Search_Talk_ViewPage_SearchForm_Component extends Kwc_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Suchfomular (Vortrag)');
        $ret['generators']['child']['component']['success'] = false;
        $ret['useAjaxRequest'] = false;
        $ret['method'] = 'get';
        return $ret;
    }
}
