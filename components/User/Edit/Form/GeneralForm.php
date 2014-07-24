<?php
class User_Edit_Form_GeneralForm extends Kwc_Abstract_Composite_Form
{
    protected function _init()
    {
        $this->setModel(Zend_Registry::get('userModel')->getKwfModel());
        parent::_init();
    }

    protected function _getIdTemplateForChild($key)
    {
        return 'users_{0}-general-'.$key;
    }

    protected function _initFields()
    {
        $this->add(new Kwf_Form_Field_TextField('email', trlKwf('E-Mail')))
                    ->setVtype('email')
                    ->setAllowBlank(false)
                    ->setWidth(250)
                    ->addValidator(new Kwc_User_Detail_General_Validate_UniqueEmail());

        $this->add(new Kwf_Form_Field_TextField('firstname', trlKwf('Firstname')))
                    ->setAllowBlank(false)
                    ->setWidth(250);

        $this->add(new Kwf_Form_Field_TextField('lastname', trlKwf('Lastname')))
                    ->setAllowBlank(false)
                    ->setWidth(250);

        parent::_initFields();
    }
}
