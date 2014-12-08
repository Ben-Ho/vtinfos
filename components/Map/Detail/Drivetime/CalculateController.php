<?php
class Map_Detail_Drivetime_CalculateController extends Kwf_Controller_Action
{
    public function jsonIndexAction()
    {
        $congregationId = $this->_getParam('congregationId');
        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        if (!$user) throw new Kwf_Exception_AccessDenied();
        $select = new Kwf_Model_Select();
        $select->where(new Kwf_Model_Select_Expr_Or(array(
            new Kwf_Model_Select_Expr_And(array(
                new Kwf_Model_Select_Expr_Equals('congregation1_id', $user->congregation_id),
                new Kwf_Model_Select_Expr_Equals('congregation2_id', $congregationId)
            )),
            new Kwf_Model_Select_Expr_And(array(
                new Kwf_Model_Select_Expr_Equals('congregation1_id', $congregationId),
                new Kwf_Model_Select_Expr_Equals('congregation2_id', $user->congregation_id)
            ))
        )));
        $row = Kwf_Model_Abstract::getInstance('Drivetimes')->getRow($select);
        if (!$row) {
            $row = Kwf_Model_Abstract::getInstance('Drivetimes')->createRow();
            $fromRow = $user->getParentRow('Congregation');
            $from = $fromRow->latitude.','.$fromRow->longitude;
            $toRow = Kwf_Model_Abstract::getInstance('Congregations')
                ->getRow($congregationId);
            $to = $toRow->latitude.','.$toRow->longitude;
            $base_url = 'http://maps.googleapis.com/maps/api/directions/xml?sensor=false';
            $xml = simplexml_load_file("$base_url&origin=$from&destination=$to");
            $row->duration = (string)$xml->route->leg->duration->text;
            $row->congregation1_id = $user->congregation_id;
            $row->congregation2_id = $congregationId;
            $row->save();
//             $this->view->newlyRequested = true;
        }
        $this->view->duration = str_replace('hour', trl('Stunden'), str_replace('mins', trl('Minuten'), $row->duration));
    }
}
