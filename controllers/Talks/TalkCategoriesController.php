<?php

class Talks_TalkCategoriesController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'TalkCategories';
    protected $_editDialog = array(
        'controllerUrl' => '/admin/talks/talk-categories',
        'width' => '400'
    );

    public function indexAction()
    {
        parent::indexAction();
        $this->view->xtype = 'vtinfos.talkCategories';
    }

    protected function _initColumns()
    {
        parent::_initColumns();
        $this->_columns->add(new Kwf_Grid_Column('id', trl('ID')));
        $this->_columns->add(new Kwf_Grid_Column('title', trl('Titel')))
            ->setEditor(new Kwf_Form_Field_TextField());
    }

    protected function _getSelect()
    {
        $select = parent::_getSelect();
        $select->order('id');
        return $select;
    }

}
