<?php
class Forms_Speakers_Component extends Kwc_Abstract_Composite_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('Rednerformular Liste');
        $ret['generators']['child']['component']['new'] = 'Forms_Speaker_Component';
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        $ret['generators']['list'] = array(
            'class' => 'Forms_Speakers_Generator',
            'component' => 'Forms_Speakers_Speaker_Component'
        );
        $ret['childModel'] = 'Speakers';
        $ret['plugins'] = array('Login_Plugin_Component');
        $ret['viewCache'] = false;
        $ret['contentSender'] = 'Forms_Speakers_ContentSender';
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['speakers'] = $this->getData()->getChildComponents(array('componentClass' => 'Forms_Speakers_Speaker_Component'));
        return $ret;
    }
}
