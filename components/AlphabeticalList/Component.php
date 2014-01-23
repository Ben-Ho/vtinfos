<?php
class AlphabeticalList_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Versammlungen A-Z');
        $ret['childModel'] = 'Congregations';
        $ret['cssClass'] = 'webStandard';
        $ret['generators']['child'] = array(
            'class' => 'AlphabeticalList_Generator',
            'component' => 'Circles_Circle_Congregation_Component'
        );
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['congregations'] = $this->getData()->getChildPages();
        return $ret;
    }
}
