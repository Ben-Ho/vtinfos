<?php
class Talks_SpeakersToTalksController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'SpeakersToTalks';

    protected function _initColumns()
    {
        parent::_initColumns();
        $comboBox = new Kwf_Form_Field_ComboBox();
        $select = new Kwf_Model_Select();
        $select->order('number');
        $comboBox->setValues(Kwf_Model_Abstract::getInstance('Talks')->getRows($select));
        $this->_columns->add(new Kwf_Grid_Column('talk_id', trl('ID'), 30))
            ->setEditor($comboBox);
//             ->setData(new Talks_SpeakersToTalksControllerTalkNumber());
        $this->_columns->add(new Kwf_Grid_Column('number', trl('Nummer'), 30));
        $this->_columns->add(new Kwf_Grid_Column('title', trl('Titel'), 300));
    }

    protected function _getSelect()
    {
        $select = parent::_getSelect();
        $select->whereEquals('speaker_id', $this->_getParam('speaker_id'));
        return $select;
    }

    protected function _beforeInsert(Kwf_Model_Row_Interface $row, $submitRow)
    {
        parent::_beforeInsert($row, $submitRow);
        $row->speaker_id = $this->_getParam('speaker_id');
    }
}
class Talks_SpeakersToTalksControllerTalkNumber extends Kwf_Data_Abstract
{
    public function load($row)
    {
        return $row->number;
    }
}
