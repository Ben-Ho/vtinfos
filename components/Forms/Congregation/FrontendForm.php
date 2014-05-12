<?php
class Forms_Congregation_FrontendForm extends Kwf_Form
{
    protected $_model = 'Congregations';

    protected function _initFields()
    {
        parent::_initFields();
        $this->add(new Kwf_Form_Field_TextField('name', trlStatic('Name')));
        $this->add(new Kwf_Form_Field_TextField('street', trlStatic('Straße')));
        $this->add(new Kwf_Form_Field_TextField('zip', trlStatic('PLZ')));
        $this->add(new Kwf_Form_Field_TextField('city', trlStatic('Stadt')));
        $selectBox = new Kwf_Form_Field_Select('country', trlStatic('Land'));
        $selectBox->setValues(array(
            'Österreich' => trlStatic('Österreich'),
            'Deutschland' => trlStatic('Deutschland')
        ));
        $this->add($selectBox);
        $this->add(new Kwf_Form_Field_TextField('talk_time', trlStatic('Vortragszeit')));
        $this->add(new Kwf_Form_Field_TextField('ministryschool_time', trlStatic('Predigtdienstschulzeit')));

        $select = new Kwf_Model_Select();
        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        $select->whereEquals('congregation_id', $user->congregation_id);
        $select->whereEquals('deleted', 0);
        $speakerRows = Kwf_Model_Abstract::getInstance('Speakers')->getRows($select);
        $selectBox = new Kwf_Form_Field_Select('coordinator', trlStatic('Koordinator'));
        $selectBox->setValues($speakerRows);
        $this->add($selectBox);
        $selectBox = new Kwf_Form_Field_Select('talk_organiser', trlStatic('Vortragseinteiler'));
        $selectBox->setValues($speakerRows);
        $this->add($selectBox);
    }

}
