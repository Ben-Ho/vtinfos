<?php
class Calendar_CongregationsController extends Kwf_Controller_Action
{
    protected function _isAllowedComponent()
    {
        $userRow = Kwf_Registry::get('userModel')->getAuthedUser();
        if (!$userRow) throw new Kwf_Exception_AccessDenied();
        if (!in_array($userRow->role, array('admin', 'talk-organiser'))) {
            throw new Kwf_Exception_AccessDenied();
        }
        return true;
    }

    public function indexAction()
    {
        $filter = $this->_getParam('congregationName');
        if (strlen($filter) < 4) exit;

        $select = new Kwf_Model_Select();
        $select->where(new Kwf_Model_Select_Expr_Like('name', '%'.$filter.'%'));
        $congregations = array();
        foreach (Kwf_Model_Abstract::getInstance('Congregations')->getRows($select) as $congregationRow) {
            $congregations[] = array(
                'label' => $congregationRow->name,
                'value' => $congregationRow->id
            );
        }
        echo json_encode(array(
            'congregations' => $congregations
        ));
        exit;
    }
}
