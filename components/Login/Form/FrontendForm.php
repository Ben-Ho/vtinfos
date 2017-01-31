<?php
class Login_Form_FrontendForm extends Kwf_Form
{
    protected function _init()
    {
        parent::_init();
        $this->_model = new Kwf_Model_FnF();

        $this->add(new Kwf_Form_Field_TextField('text', trlStatic('Login')))
            ->setCls('loginInput')
            ->setAllowBlank(false);

        $this->add(new Kwf_Form_Field_Password('password', trlKwfStatic('Password')))
            ->setCls('loginInput')
            ->setAllowBlank(false);
    }
}
