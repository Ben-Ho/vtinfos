<?php
class Talks_CircleGroupsController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'CircleGroups';

    protected function _initColumns()
    {
        parent::_initColumns();
        $this->_columns->add(new Kwf_Grid_Column('name', trl('Name')))
            ->setEditor(new Kwf_Form_Field_TextField());
    }
}
