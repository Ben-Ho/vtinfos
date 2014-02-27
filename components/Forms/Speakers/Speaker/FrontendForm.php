<?php
class Forms_Speakers_Speaker_FrontendForm extends Forms_Speaker_FrontendForm
{
    protected $_model = 'Speakers';

    protected function _initFields()
    {
        parent::_initFields();
        $this->add(new Kwf_Form_Field_Checkbox('deleted', trl('Redner löschen')));
    }
}
