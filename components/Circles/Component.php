<?php
class Circles_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['childModel'] = 'Circles';
        $ret['componentName'] = trlStatic('Versammlungs-Kreise');
        $ret['cssClass'] = 'webStandard';
        $ret['generators']['child'] = array(
            'class' => 'Kwf_Component_Generator_Table',
            'component' => 'Circles_Circle_Component'
        );
        $ret['assets']['dep'][] = 'KwfResponsiveEl';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $circles = array();
        foreach ($this->getData()->getChildComponents(array('componentClass' => 'Circles_Circle_Component')) as $circle) {
            $circles[$circle->getRow()->getParentRow('Group')->name][] = $circle;
        }
        $ret['circles'] = $circles;
        return $ret;
    }
}
