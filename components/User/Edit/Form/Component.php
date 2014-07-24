<?php
class User_Edit_Form_Component extends Kwc_User_Edit_Form_Component
{
    protected function _initUserForm()
    {
        $this->_form->add(new User_Edit_Form_GeneralForm('general', null))
            ->setIdTemplate("{0}");
    }
}
