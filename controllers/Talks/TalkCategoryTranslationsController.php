<?php
class Talks_TalkCategoryTranslationsController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'TalkCategoryTitles';

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
        $select->whereEquals('category_id', $this->_getParam('category_id'));
        return $select;
    }

    protected function _beforeSave(Kwf_Model_Row_Interface $row, $submitRow)
    {
        if ($row->language || $row->title) {
            $row->category_id = $this->_getParam('category_id');
        }
        parent::_beforeSave($row, $submitRow);
    }
}
