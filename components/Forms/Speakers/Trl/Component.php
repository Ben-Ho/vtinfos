<?php
class Forms_Speakers_Trl_Component extends Kwc_Abstract_Composite_Trl_Component
{
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['speakers'] = $this->getData()->getChildComponents(
            array('componentClass' => 'Kwc_Form_Trl_Component.Forms_Speakers_Speaker_Component'));
        return $ret;
    }
}
