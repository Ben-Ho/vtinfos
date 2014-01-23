<?php
class Talks_CongregationsController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'Congregations';

    //TODO add form to add congregation with koordinator und ve auswahl
    protected function _initColumns()
    {
        parent::_initColumns();
        $this->_columns->add(new Kwf_Grid_Column('name', trl('Name')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('street', trl('Straße')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('zip', trl('PLZ')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('city', trl('Ort')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('country', trl('Land')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('talk_time', trl('Vortrag Zeit/Tag')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('ministryschool_time', trl('Predigtdienstschule Zeit/Tag')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('coordinator', trl('Koordinator')))
            ->setEditor(new Kwf_Form_Field_NumberField());
        $this->_columns->add(new Kwf_Grid_Column('talk_organiser', trl('Vortragseinteiler')))
            ->setEditor(new Kwf_Form_Field_NumberField());
    }

    protected function _getSelect()
    {
        $select = parent::_getSelect();
        $select->whereEquals('circle_id', $this->_getParam('circle_id'));
        return $select;
    }

    protected function _beforeInsert(Kwf_Model_Row_Interface $row, $submitRow)
    {
        parent::_beforeInsert($row, $submitRow);
        $row->circle_id = $this->_getParam('circle_id');
    }
}
