<?php
class Forms_Speakers_Speaker_FrontendForm extends Forms_Speaker_FrontendForm
{
    protected function _initFields()
    {
        parent::_initFields();
        $this->add(new Kwf_Form_Field_Checkbox('deleted', trlStatic('Redner löschen')));
    }
}
