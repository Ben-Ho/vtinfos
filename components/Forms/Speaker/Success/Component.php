<?php
class Forms_Speaker_Success_Component extends Kwc_Abstract
{
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        header('Location: '.$this->getData()->parent->getAbsoluteUrl());
        exit;
        return $ret;
    }
}
