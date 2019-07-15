<?php
class Circles extends Kwf_Model_Db
{
    protected $_table = 't_circles';
    protected $_toStringField = 'name';

    protected $_referenceMap = array(
        'Group' => array(
            'refModelClass' => 'CircleGroups',
            'column' => 'group_id'
        )
    );

    protected $_dependentModels = array(
        'Congregations' => 'Congregations'
    );

    protected $_serialization = array(
        'name' => 'rest_read'
    );

    protected function _init()
    {
        parent::_init();
        $this->_exprs['group'] = new Kwf_Model_Select_Expr_Parent('Group', 'name');
    }
}
