<?php
class Talks_Component extends Kwc_Abstract
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('Vortragsthemen');
        $ret['rootElementClass'] = 'kwfUp-webStandard';

        $ret['generators']['talks'] = array(
            'component' => 'Talks_Talk_Component',
            'class' => 'Talks_TalkGenerator',
            'model' => 'Talks'
        );

        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $select = new Kwf_Component_Select();
        $select->whereGenerator('talks');
        $select->order('number');
        $ret['talkComponents'] = $this->getData()->getChildComponents($select);
        return $ret;
    }
}
