<?php
/**
 * @package Form
 */
class Forms_Speaker_Field_PhoneField extends Kwf_Form_Field_TextField
{
    protected function _addValidators()
    {
        parent::_addValidators();
        $this->addValidator(new Forms_Speaker_Validators_Phone(), 'format');
    }
}
