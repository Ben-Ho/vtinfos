<?php
class Talks_SpeakersController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'Speakers';

    protected function _initColumns()
    {
        parent::_initColumns();
        $select = new Kwf_Model_Select();
        $select->order('name');
        $congregationsRows = Kwf_Model_Abstract::getInstance('Congregations')->getRows($select);
        $congregations = array();
        foreach ($congregationsRows as $congregationRow) {
            $congregations[$congregationRow->id] = $congregationRow->name;
        }

        $comboBox = new Kwf_Form_Field_ComboBox();
        $comboBox->setValues($congregations);
        $this->_columns->add(new Kwf_Grid_Column('congregation_id', trl('Versammlung'), 100))
            ->setEditor($comboBox);
        $this->_columns->add(new Kwf_Grid_Column('firstname', trl('Vorname')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('lastname', trl('Nachname')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $selectField = new Kwf_Form_Field_Select();
        $selectField->setValues(array(
            'eldest' => trl('Ältester'),
            'ministry_assistent' => trl('DAG')
        ));

        $this->_columns->add(new Kwf_Grid_Column('degree', trl('Vorrecht')))
//             ->setData(new Talks_SpeakersControllerDegree())
            ->setEditor($selectField);
        $this->_columns->add(new Kwf_Grid_Column('street', trl('Straße')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('zip', trl('PLZ')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('city', trl('Ort')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('country', trl('Land')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('phone', trl('Telefon')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('email', trl('Email')))
            ->setEditor(new Kwf_Form_Field_TextField());
    }

    protected function _getSelect()
    {
        $select = parent::_getSelect();
        $select->whereEquals('congregation_id', $this->_getParam('congregation_id'));
        return $select;
    }

    protected function _beforeInsert(Kwf_Model_Row_Interface $row, $submitRow)
    {
        parent::_beforeInsert($row, $submitRow);
        $row->congregation_id = $this->_getParam('congregation_id');
    }
}
class Talks_SpeakersControllerDegree extends Kwf_Data_Abstract
{
    public function load($row)
    {
        if ($row->degree == 'eldest') {
            return trl('Ältester');
        } else if ($row->degree == 'ministry_assistent') {
            return trl('DAG');
        }
        return '';
    }
}
