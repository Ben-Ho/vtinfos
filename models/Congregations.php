<?php
class Congregations extends Kwf_Model_Db
{
    protected $_table = 't_congregations';
    protected $_toStringField = 'name';

    protected $_referenceMap = array(
        'Circle' => array(
            'refModelClass' => 'Circles',
            'column' => 'circle_id'
        )
    );

    protected $_dependentModels = array(
        'Speakers' => 'Speakers',
        'Drivetimes' => 'Drivetimes'
    );
    protected function _init()
    {
        parent::_init();
        $this->_exprs['circle_name'] = new Kwf_Model_Select_Expr_Parent('Circle', 'name');
    }
}
