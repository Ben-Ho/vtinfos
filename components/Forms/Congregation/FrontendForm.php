<?php
class Forms_Congregation_FrontendForm extends Kwf_Form
{
    protected $_model = 'Congregations';

    protected function _initFields()
    {
        parent::_initFields();
        $this->add(new Kwf_Form_Field_TextField('name', trl('Name')));
        $this->add(new Kwf_Form_Field_TextField('street', trl('Straße')));
        $this->add(new Kwf_Form_Field_TextField('zip', trl('PLZ')));
        $this->add(new Kwf_Form_Field_TextField('city', trl('Stadt')));
        $selectBox = new Kwf_Form_Field_Select('country', trl('Land'));
        $selectBox->setValues(array(
            'Österreich' => trl('Österreich'),
            'Deutschland' => trl('Deutschland')
        ));
        $this->add($selectBox);
        $this->add(new Kwf_Form_Field_TextField('talk_time', trl('Vortragszeit')));
        $this->add(new Kwf_Form_Field_TextField('ministryschool_time', trl('Predigtdienstschulzeit')));

        $select = new Kwf_Model_Select();
        if ($this->getId()) {
            $select->whereEquals('congregation_id', $this->getId());
        }
        $speakerRows = Kwf_Model_Abstract::getInstance('Speakers')->getRows($select);
        $selectBox = new Kwf_Form_Field_Select('coordinator', trl('Koordinator'));
        $selectBox->setValues($speakerRows);
        $this->add($selectBox);
        $selectBox = new Kwf_Form_Field_Select('talk_organiser', trl('Vortragseinteiler'));
        $selectBox->setValues($speakerRows);
        $this->add($selectBox);
    }

}
