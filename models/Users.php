<?php
class Users extends Kwf_User_Model
{
    protected function _init()
    {
        parent::_init();
        $this->_referenceMap['Congregation'] = array(
            'refModelClass' => 'Congregations',
            'column' => 'congregation_id'
        );
    }
}
