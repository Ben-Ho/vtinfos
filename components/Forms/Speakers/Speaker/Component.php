<?php
class Forms_Speakers_Speaker_Component extends Forms_Speaker_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['hideFormOnSuccess'] = false;
        $ret['generators']['child']['component']['success'] = null;
        $ret['placeholder']['submitButton'] = trlStatic('Speichern');
        $ret['viewCache'] = false;
        return $ret;
    }

    protected function _initForm()
    {
        parent::_initForm();
        $data = $this->getData();
        if ($this->getData()->getParent()->componentClass != 'Forms_Speakers_Component') {
            $data = $this->getData()->getParent();
        }
        $this->getForm()->setId($data->getRow()->id);
    }
}