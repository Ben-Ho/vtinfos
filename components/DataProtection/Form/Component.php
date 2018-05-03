<?php
class DataProtection_Form_Component extends Kwc_Form_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['placeholder']['submitButton'] = trlStatic('Akzeptieren');
        return $ret;
    }

    protected function _initForm()
    {
        parent::_initForm();
        $this->_form->setModel(new Kwf_Model_FnF());
        $this->_form->add(new Kwf_Form_Field_Checkbox('data_privacy'))
            ->setBoxLabel(trl('Akzeptiere den Datenschutz'))
            ->setAllowBlank(false);
    }

    protected function _beforeSave(Kwf_Model_Row_Interface $row)
    {
        parent::_beforeSave($row);
        if ($row->data_privacy) {
            $userRow = Kwf_Registry::get('userModel')->getAuthedUser();
            $userRow->data_privacy = date('Y-m-d H:i:s');
            $userRow->data_privacy_ip = $_SERVER['REMOTE_ADDR'];
            $userRow->save();
        }
    }
}
