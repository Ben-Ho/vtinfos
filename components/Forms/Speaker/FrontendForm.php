<?php
class Forms_Speaker_FrontendForm extends Kwf_Form
{
    protected $_model = 'Speakers';

    protected function _initFields()
    {
        parent::_initFields();
        $this->add(new Kwf_Form_Field_TextField('firstname', trl('Vorname')));
        $this->add(new Kwf_Form_Field_TextField('lastname', trl('Nachname')));
        $selectBox = new Kwf_Form_Field_Select('degree', trl('Vorrecht'));
        $selectBox->setValues(array(
            'eldest' => trl('Ältester'),
            'ministry_assistent' => trl('Dienstamtgehilfe')
        ));
        $this->add($selectBox);
        $this->add(new Kwf_Form_Field_TextField('street', trl('Straße')));
        $this->add(new Kwf_Form_Field_TextField('zip', trl('PLZ')));
        $this->add(new Kwf_Form_Field_TextField('city', trl('Stadt')));
        $selectBox = new Kwf_Form_Field_Select('country', trl('Land'));
        $selectBox->setValues(array(
            'Österreich' => trl('Österreich'),
            'Deutschland' => trl('Deutschland')
        ));
        $this->add($selectBox);
        $this->add(new Kwf_Form_Field_TextField('phone', trl('Telefonnummer')));
        $this->add(new Kwf_Form_Field_TextField('email', trl('Email-Adresse')));

        $select = new Kwf_Model_Select();
        $select->order('number');
        $this->add(new Kwf_Form_Field_MultiCheckbox('SpeakerToTalks', 'Talk', trl('Vorträge')))
            ->setShowCheckAllLinks(false)
            ->setValuesSelect($select);
        $this->add(new Kwf_Form_Field_TextArea('note', trl('Notiz')));
    }
}
