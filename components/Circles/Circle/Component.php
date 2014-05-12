<?php
class Circles_Circle_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Versammlungen');
        $ret['cssClass'] = 'webStandard';
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['congregations'] = array();
        foreach ($this->getData()->getRow()->getChildRows('Congregations') as $congregationRow) {
            $component = Kwf_Component_Data_Root::getInstance()->getComponentByClass('Directories_Congregations_Component');
            $ret['congregations'][] = $component->getChildComponent('_'.$congregationRow->id);
        }
        return $ret;
    }
}
