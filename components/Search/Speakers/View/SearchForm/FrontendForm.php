<?php
class Search_Speakers_View_SearchForm_FrontendForm extends Kwf_Form
{
    protected function _initFields()
    {
        parent::_initFields();
        $this->_model = new Kwf_Model_FnF();
        $this->add(new Kwf_Form_Field_TextField('talk_number', trlStatic('Vortragsnummer/-titel')));
        $combobox = $this->add(new Kwf_Form_Field_Select('talk_language', trlStatic('Vortragssprache')));
        $languages = array();
        foreach (Talks::getLanguages() as $code) {
            $languages[$code] = Talks::getLanguage($code);
        }
        $combobox->setValues($languages);
        $this->add(new Kwf_Form_Field_TextField('firstname', trlStatic('Vorname')));
        $this->add(new Kwf_Form_Field_TextField('lastname', trlStatic('Nachname')));
        $this->add(new Kwf_Form_Field_TextField('phone', trlStatic('Telefonnummer')));
        $comboBox = new Kwf_Form_Field_Select('congregation', trlStatic('Versammlung'));
        $comboBox->setShowNoSelection(true);
        $select = new Kwf_Model_Select();
        $select->order('name');
        $congregationRows = Kwf_Model_Abstract::getInstance('Congregations')->getRows($select);
        $comboBox->setValues($congregationRows);
        $this->add($comboBox);

        $select = new Kwf_Model_Select();
        $select->order('name');
        $circleGroupRows = Kwf_Model_Abstract::getInstance('CircleGroups')->getRows($select);
        $data = array();
        foreach ($circleGroupRows as $circleGroupRow) {
            $data['g_'.$circleGroupRow->id] = $circleGroupRow->name;
            foreach ($circleGroupRow->getChildRows('Circles', $select) as $circleRow) {
                $data['c_'.$circleRow->id] = ' - '.$circleRow->name;
            }
        }
        $comboBox = new Kwf_Form_Field_Select('circle', trlStatic('Kreis'));
        $comboBox->setShowNoSelection(true);
        $comboBox->setValues($data);
        $this->add($comboBox);
        $this->add(new Kwf_Form_Field_TextArea('distance', trlStatic('Luftlinie (km)')))
            ->setDefaultValue("50")
            ->setHeight(18)
            ->setWidth(219);
        $this->add(new Kwf_Form_Field_Checkbox('no_beard', trlStatic('Kein Voll-/Modebart')));
    }
}
