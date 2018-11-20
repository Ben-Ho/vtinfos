<?php
class Talks_TalkCategoriesToTalksController extends Kwf_Controller_Action_Auto_AssignGrid
{
    protected $_paging = 10;
    protected $_modelName = 'TalksToCategories';
    protected $_assignFromReference = 'Talk';
    protected $_filters = array('text'=>true);

    protected function _createAssignRow($id)
    {
        $row = $this->_getModel()->createRow();
        $row->talk_id = $id;
        $row->category_id = $this->_getParam('category_id');
        return $row;
    }

    protected function _initColumns()
    {
        parent::_initColumns();
        $this->_columns->add(new Kwf_Grid_Column('number', trl('Nummer')));
        $this->_columns->add(new Kwf_Grid_Column('title', trl('Titel'), 350));
    }

    protected function _getSelect()
    {
        $ret = parent::_getSelect();
        $ret->whereEquals('category_id', $this->_getParam('category_id'));
        return $ret;
    }
}
