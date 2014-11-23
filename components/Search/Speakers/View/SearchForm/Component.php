<?php
class Search_Speakers_View_SearchForm_Component extends Kwc_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Suchfomular (Vortrag)');
        $ret['generators']['child']['component']['success'] = false;
        $ret['useAjaxRequest'] = false;
        $ret['method'] = 'get';
        $ret['placeholder']['submitButton'] = trlKwfStatic('Search');
        return $ret;
    }
}
