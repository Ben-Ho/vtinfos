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
    }

    public function loginUserRow($row, $logLogin)
    {
        return parent::loginUserRow($row, true);
    }
}
