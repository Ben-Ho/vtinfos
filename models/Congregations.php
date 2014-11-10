<?php
class Congregations extends Kwf_Model_Db
{
    protected $_table = 't_congregations';
    protected $_toStringField = 'name';

    protected $_referenceMap = array(
        'Circle' => array(
            'refModelClass' => 'Circles',
            'column' => 'circle_id'
        ),
        'Address' => array(
            'refModelClass' => 'CongregationAddresses',
            'column' => 'address_id'
        )
    );

    protected $_dependentModels = array(
        'Speakers' => 'Speakers'
    );
    protected function _init()
    {
        parent::_init();
        $this->_exprs['street'] = new Kwf_Model_Select_Expr_Parent('Address', 'street');
        $this->_exprs['zip'] = new Kwf_Model_Select_Expr_Parent('Address', 'zip');
        $this->_exprs['city'] = new Kwf_Model_Select_Expr_Parent('Address', 'city');
        $this->_exprs['country'] = new Kwf_Model_Select_Expr_Parent('Address', 'country');
    }
}
