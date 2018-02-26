<?php
class Search_Trl_Component extends Kwc_Chained_Trl_Component
{
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['config']['settings']['language'] = $this->getData()->getLanguage();
        return $ret;
    }
}
