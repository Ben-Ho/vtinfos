<?php
class Talks_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Vortragsthemen');
        $ret['cssClass'] = 'webStandard';
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $select = new Kwf_Model_Select();
        $select->order('number');
        $ret['talks'] = Kwf_Model_Abstract::getInstance('Talks')->getRows($select);
        $ret['language'] = $this->getData()->getLanguage();
        return $ret;
    }
}
