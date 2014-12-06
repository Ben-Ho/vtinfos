<?php
class Forms_Congregation_FrontendForm extends Kwf_Form
{
    protected $_model = 'Congregations';

    protected function _initFields()
    {
        parent::_initFields();
        $width = 250;
        $this->add(new Kwf_Form_Field_TextField('name', trlStatic('Name')))
            ->setWidth($width);
        $this->add(new Kwf_Form_Field_TextField('street', trlStatic('Straße')))
            ->setWidth($width);
        $this->add(new Kwf_Form_Field_TextField('zip', trlStatic('PLZ')))
            ->setWidth($width);
        $this->add(new Kwf_Form_Field_TextField('city', trlStatic('Stadt')))
            ->setWidth($width);
        $this->add(new Kwf_Form_Field_SelectCountry('country', trlStatic('Land')))
            ->setDefaultValue('AT')
            ->setWidth($width);
        $this->add(new Kwf_Form_Field_TextField('talk_time', trlStatic('Vortragszeit')))
            ->setWidth($width);
        $this->add(new Kwf_Form_Field_TextField('ministryschool_time', trlStatic('Predigtdienstschulzeit')))
            ->setWidth($width);

        $select = new Kwf_Model_Select();
        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        $select->whereEquals('congregation_id', $user->congregation_id);
        $select->whereEquals('deleted', 0);
        $speakerRows = Kwf_Model_Abstract::getInstance('Speakers')->getRows($select);
        $selectBox = new Kwf_Form_Field_Select('coordinator', trlStatic('Koordinator'));
        $selectBox->setValues($speakerRows)
            ->setWidth($width);
        $this->add($selectBox);
    }

}
