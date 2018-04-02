<?php
class Login_Form_FrontendForm extends Kwf_Form
{
    protected function _init()
    {
        parent::_init();
        $this->_model = new Kwf_Model_FnF();

        $this->add(new Kwf_Form_Field_TextField('text', trlKwfStatic('User')))
            ->setEmptyText(trlKwfStatic('E-Mail Address'))
            ->setAutofocus(true)
            ->setAllowBlank(false);

        $this->add(new Kwf_Form_Field_Password('password', trlKwfStatic('Password')))
            ->setEmptyText('••••••••')
            ->setAllowBlank(false);
    }
}
