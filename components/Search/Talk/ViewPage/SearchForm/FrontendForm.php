<?php
class Search_Talk_ViewPage_SearchForm_FrontendForm extends Kwf_Form
{
    protected function _initFields()
    {
        parent::_initFields();
        $this->_model = new Kwf_Model_FnF();
        $this->add(new Kwf_Form_Field_TextField('talk_number', trl('Vortragsnummer/-titel')));
        $this->add(new Kwf_Form_Field_TextField('firstname', trl('Vorname')));
        $this->add(new Kwf_Form_Field_TextField('lastname', trl('Nachname')));
        $comboBox = new Kwf_Form_Field_Select('congregation', trl('Versammlung'));
        $comboBox->setShowNoSelection(true);
        $select = new Kwf_Model_Select();
        $select->order('name');
        $congregationRows = Kwf_Model_Abstract::getInstance('Congregations')->getRows($select);
        $comboBox->setValues($congregationRows);
        $this->add($comboBox);
        $this->add(new Kwf_Form_Field_TextField('distance', trl('Luftlinie (km)')));
    }
}
