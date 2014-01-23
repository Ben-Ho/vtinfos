<?php
class Circles_Circle_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Versammlungen');
        $ret['childModel'] = 'Congregations';
        $ret['cssClass'] = 'webStandard';
        $ret['generators']['child'] = array(
            'class' => 'Circles_Circle_Generator',
            'component' => 'Circles_Circle_Congregation_Component'
        );
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['congregations'] = $this->getData()->getChildPages();
        return $ret;
    }
}
