<?php
class User_UsersController extends Kwf_Controller_Action_User_UsersController
{
    protected $_queryFields = array('id', 'email', 'firstname', 'lastname', 'congregation_name', 'wp_user');

    protected function _initColumns()
    {
        parent::_initColumns();
        $this->_columns->add(new Kwf_Grid_Column('congregation_name', trl('Versammlung')));
        $this->_columns->add(new Kwf_Grid_Column('wp_user', trl('Login-Name')));
        $this->_columns->add(new Kwf_Grid_Column('logins', trl('Logins'), 50));
        $this->_columns->add(new Kwf_Grid_Column('last_login', trl('Letzer Login')));
    }
}
