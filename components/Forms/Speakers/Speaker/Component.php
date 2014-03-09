<?php
class Forms_Speakers_Speaker_Component extends Forms_Speaker_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['hideFormOnSuccess'] = false;
        $ret['generators']['child']['component']['success'] = null;
        $ret['placeholder']['submitButton'] = trlStatic('Speichern');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $this->getForm()->setId($this->getData()->getRow()->id);
        $ret = parent::getTemplateVars($renderer);
        return $ret;
    }
}