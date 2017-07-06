<?php
class User_Edit_Form_GeneralForm extends Kwc_Abstract_Composite_Form
{
    protected function _init()
    {
        $this->setModel(Kwf_Registry::get('userModel')->getEditModel());
        parent::_init();
    }

    protected function _getIdTemplateForChild($key)
    {
        return 'users_{0}-general-'.$key;
    }

    protected function _initFields()
    {
        $width = 250;
        $this->add(new Kwf_Form_Field_EMailField('email', trlKwf('E-Mail')))
                    ->setAllowBlank(false)
                    ->setWidth($width)
                    ->addValidator(new Kwc_User_Detail_General_Validate_UniqueEmail());

        $this->add(new Kwf_Form_Field_TextField('firstname', trlKwf('Firstname')))
                    ->setAllowBlank(false)
                    ->setWidth($width);

        $this->add(new Kwf_Form_Field_TextField('lastname', trlKwf('Lastname')))
                    ->setAllowBlank(false)
                    ->setWidth($width);

        $this->add(new Kwf_Form_Field_TextField('phone', trlKwf('Phone')))
                    ->setAllowBlank(false)
                    ->setWidth($width);

        parent::_initFields();
    }
}
