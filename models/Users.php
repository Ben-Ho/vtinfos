<?php
class Users extends Kwf_User_Model
{
    protected $_rowClass = 'Rows_User';

    protected function _init()
    {
        parent::_init();
        $this->_referenceMap['Congregation'] = array(
            'refModelClass' => 'Congregations',
            'column' => 'congregation_id'
        );
        $this->_exprs['congregation_name'] = new Kwf_Model_Select_Expr_Parent('Congregation', 'name');
    }

    public function loginUserRow($row, $logLogin)
    {
        return parent::loginUserRow($row, true);
    }
}
