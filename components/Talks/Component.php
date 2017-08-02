<?php
class Talks_Component extends Kwc_Abstract
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('Vortragsthemen');
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $select = new Kwf_Model_Select();
        $select->order('number');
        $ret['talks'] = Kwf_Model_Abstract::getInstance('Talks')->getRows($select);
        $ret['talkCategories'] = Kwf_Model_Abstract::getInstance('TalkCategories')->getRows();
        $ret['talksToCategories'] = Kwf_Model_Abstract::getInstance('TalksToCategories')->getRows();
        $ret['language'] = $this->getData()->getLanguage();
        return $ret;
    }
}
