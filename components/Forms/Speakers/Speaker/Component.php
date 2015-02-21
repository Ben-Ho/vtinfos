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
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    protected function _initForm()
    {
        parent::_initForm();
        $this->getForm()->setId($this->getData()->row->id);
    }
}
