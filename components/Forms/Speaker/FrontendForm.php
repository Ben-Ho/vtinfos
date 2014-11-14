<?php
class Forms_Speaker_FrontendForm extends Kwf_Form
{
    protected $_model = 'Speakers';

    protected function _initFields()
    {
        parent::_initFields();
        $this->add(new Kwf_Form_Field_TextField('firstname', trlStatic('Vorname')));
        $this->add(new Kwf_Form_Field_TextField('lastname', trlStatic('Nachname')));
        $selectBox = new Kwf_Form_Field_Select('degree', trlStatic('Vorrecht'));
        $selectBox->setValues(array(
            'eldest' => trlStatic('Ältester'),
            'ministry_assistent' => trlStatic('Dienstamtgehilfe')
        ));
        $this->add($selectBox);
        $this->add(new Kwf_Form_Field_TextField('street', trlStatic('Straße')));
        $this->add(new Kwf_Form_Field_TextField('zip', trlStatic('PLZ')));
        $this->add(new Kwf_Form_Field_TextField('city', trlStatic('Stadt')));
        $selectBox = new Kwf_Form_Field_Select('country', trlStatic('Land'));
        $selectBox->setValues(array(
            'Österreich' => trlStatic('Österreich'),
            'Deutschland' => trlStatic('Deutschland')
        ));
        $this->add($selectBox);
        $this->add(new Kwf_Form_Field_TextField('phone', trlStatic('Telefonnummer')));
        $this->add(new Kwf_Form_Field_TextField('phone2', trlStatic('Telefonnummer2')));
        $this->add(new Kwf_Form_Field_TextField('email', trlStatic('Email-Adresse')));

        $select = new Kwf_Model_Select();
        $select->order('number');
        $this->add(new Kwf_Form_Field_MultiCheckbox('SpeakerToTalks', 'Talk', trlStatic('Vorträge')))
            ->setShowCheckAllLinks(false)
            ->setValuesSelect($select);
        $this->add(new Kwf_Form_Field_TextArea('note', trlStatic('Notiz')));
    }
}
