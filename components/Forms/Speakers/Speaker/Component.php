<?php
class Forms_Speakers_Speaker_Component extends Forms_Speaker_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
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
        $data = $this->getData();
        // wird benötigt damit auch englisches bearbeiten funnktioniert
        if ($this->getData()->getParent()->componentClass != 'Forms_Speakers_Component') {
            $data = $this->getData()->getParent();
        }
        $this->getForm()->setId($data->getRow()->id);
    }
}
