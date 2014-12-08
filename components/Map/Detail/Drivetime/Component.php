<?php
class Map_Detail_Drivetime_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['viewCache'] = false;
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        foreach (explode(';', $this->getData()->parent->row->congregationIds) as $congregationId) {
            if (!$congregationId) continue;
            if (!isset($ret['travelTime'])) {
                $ret['congregationId'] = $congregationId;
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
                $rows = Kwf_Model_Abstract::getInstance('Drivetimes')->getRows($select);
                if (count($rows)) {
                    $ret['travelTime'] = str_replace('hour', trl('Stunden'), str_replace('mins', trl('Minuten'), $rows[0]->duration));
                }
            }
        }
        return $ret;
    }
}
