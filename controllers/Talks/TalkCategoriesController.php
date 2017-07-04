<?php

class Talks_TalkCategoriesController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'TalkCategories';

    protected function _initColumns()
    {
    parent::_initColumns();
    $this->_columns->add(new Kwf_Grid_Column('id', trl('ID')));
    $this->_columns->add(new Kwf_Grid_Column('title', trl('Titel')))
        ->setEditor(new Kwf_Form_Field_TextField());
    }
}
