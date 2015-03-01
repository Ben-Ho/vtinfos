<?php
class Talks_TalkTranslationsController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'TalkTitles';

    protected function _initColumns()
    {
        parent::_initColumns();
        $this->_columns->add(new Kwf_Grid_Column('language', trl('Sprache')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('title', trl('Titel'), 350))
            ->setEditor(new Kwf_Form_Field_TextField());
    }

    protected function _getSelect()
    {
        $select = parent::_getSelect();
        $select->whereEquals('talk_id', $this->_getParam('talk_id'));
        return $select;
    }
}
