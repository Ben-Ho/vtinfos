<?php
class Talks_SpeakersToTalksController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'SpeakersToTalks';

    protected function _initColumns()
    {
        parent::_initColumns();
        $select = new Kwf_Model_Select();
        $select->order('number');
        $talkRows = Kwf_Model_Abstract::getInstance('Talks')->getRows($select);
        $talks = array();
        foreach ($talkRows as $talkRow) {
            $talks[$talkRow->id] = $talkRow->number.' '.$talkRow->title;
        }

        $comboBox = new Kwf_Form_Field_ComboBox();
        $comboBox->setValues($talks);
        $this->_columns->add(new Kwf_Grid_Column('talk_id', trl('ID-Auswahl'), 100))
            ->setEditor($comboBox);
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
