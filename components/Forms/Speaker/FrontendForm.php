<?php
class Forms_Speaker_FrontendForm extends Kwf_Form
{
    protected $_model = 'Speakers';

    protected function _initFields()
    {
        parent::_initFields();
        $this->add(new Kwf_Form_Field_TextField('lastname', trlStatic('Nachname')));
        $this->add(new Kwf_Form_Field_TextField('firstname', trlStatic('Vorname')));
        $selectBox = new Kwf_Form_Field_Select('degree', trlStatic('Vorrecht'));
        $selectBox->setValues(array(
            'e' => trlStatic('Ä'),
            'm' => trlStatic('DAG'),
            '?' => '?'
        ));
        $this->add($selectBox);
        $this->add(new Forms_Speaker_Field_PhoneField('phone', trlStatic('Telefonnummer')));
        $this->add(new Forms_Speaker_Field_PhoneField('phone2', trlStatic('Telefonnummer').' 2'));
        $this->add(new Kwf_Form_Field_TextField('email', trlStatic('Email-Adresse')));

        $this->add(new Kwf_Form_Field_TextArea('note', trlStatic('Notiz (z.B. nur im Umkreis von...)')));
        $this->add(new Kwf_Form_Field_Checkbox('has_beard', trlStatic('Mode-/Vollbart')));

        $select = new Kwf_Model_Select();
        $select->order('number');
        $this->add(new Forms_Speaker_Field_SuperBoxSelect('SpeakerToTalks', 'Talk', trlStatic('Vorträge')))
            ->setValuesSelect($select);
    }
}
