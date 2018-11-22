<?php
class Talks_TalkChangesController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'TalkChanges';

    protected function _initColumns()
    {
        parent::_initColumns();
        $selectField = new Kwf_Form_Field_Select();
        $selectField->setValues(array(
            'removed' => trl('Nicht mehr halten'),
            'changed_title' => trl('Titel geändert (alten Titel in Zusatzinformation eintragen)'),
            'changed_dispo' => trl('Disposition geändert')
        ));
        $this->_columns->add(new Kwf_Grid_Column('change_type', trl('Änderung')))
            ->setEditor($selectField)
            ->setData(new Talks_TalkChangesControllerTypes());
        $this->_columns->add(new Kwf_Grid_Column_Date('change_date', trl('Gültig ab')))
            ->setEditor(new Kwf_Form_Field_DateField());
        $this->_columns->add(new Kwf_Grid_Column('change_info', trl('Zusatzinformation'), 350))
            ->setEditor(new Kwf_Form_Field_TextField());
    }

    protected function _getSelect()
    {
        $select = parent::_getSelect();
        $select->whereEquals('talk_id', $this->_getParam('talk_id'));
        $select->order('change_date', 'DESC');
        return $select;
    }

    protected function _beforeInsert(Kwf_Model_Row_Interface $row, $submitRow)
    {
        parent::_beforeInsert($row, $submitRow);
        $row->talk_id = $this->_getParam('talk_id');
    }
}
class Talks_TalkChangesControllerTypes extends Kwf_Data_Abstract
{
    public function load($row, array $info = array())
    {
        $values = array(
            'removed' => trl('Nicht mehr halten'),
            'changed_title' => trl('Titel geändert (alten Titel in Zusatzinformation eintragen)'),
            'changed_dispo' => trl('Disposition geändert')
        );
        return $values[$row->change_type];
    }
}
