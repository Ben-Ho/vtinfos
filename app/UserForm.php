<?php
class UserForm extends Kwf_User_Form
{
    protected function _initFields()
    {
        parent::_initFields();
        $this->fields->add(new Kwf_Form_Field_TextField('wp_user', trl('Benutzername')));
        $congregationRows = Kwf_Model_Abstract::getInstance('Congregations')->getRows();
        $this->fields->add(new Kwf_Form_Field_Select('congregation_id', trl('Versammlung')))
            ->setValues($congregationRows);
    }
}
