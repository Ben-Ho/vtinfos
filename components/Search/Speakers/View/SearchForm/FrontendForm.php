<?php
class Search_Speakers_View_SearchForm_FrontendForm extends Kwf_Form
{
    protected function _initFields()
    {
        parent::_initFields();
        $this->_model = new Kwf_Model_FnF();
        $this->add(new Kwf_Form_Field_TextField('talk_number', trlStatic('Vortragsnummer/-titel')));
        $this->add(new Kwf_Form_Field_TextField('firstname', trlStatic('Vorname')));
        $this->add(new Kwf_Form_Field_TextField('lastname', trlStatic('Nachname')));
        $comboBox = new Kwf_Form_Field_Select('congregation', trlStatic('Versammlung'));
        $comboBox->setShowNoSelection(true);
        $select = new Kwf_Model_Select();
        $select->order('name');
        $congregationRows = Kwf_Model_Abstract::getInstance('Congregations')->getRows($select);
        $comboBox->setValues($congregationRows);
        $this->add($comboBox);
        $this->add(new Kwf_Form_Field_TextField('distance', trlStatic('Luftlinie (km)')));
    }
}
