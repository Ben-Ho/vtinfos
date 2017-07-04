<?php
class Talks_TalkController extends Kwf_Controller_Action_Auto_Form
{
    protected $_model = 'Talks';
    protected $_permissions = array('add','save');

    protected function _initFields()
    {
        $this->_form->add(new Kwf_Form_Field_NumberField('number', trl('Nummer')));
        $this->_form->add(new Kwf_Form_Field_TextArea('title', trl('Titel')));
        $this->_form->add(new Kwf_Form_Field_MultiCheckbox('TalksToCategories', 'Category', trl('Kategorien')));
    }
}
