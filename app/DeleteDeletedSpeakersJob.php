<?php
class DeleteDeletedSpeakersJob extends Kwf_Util_Maintenance_Job_Abstract
{
    public function getFrequency()
    {
        return Kwf_Util_Maintenance_Job_Abstract::FREQUENCY_DAILY;
    }

    private function _getSelect()
    {
        $select = new Kwf_Model_Select();
        $select->ignoreDeleted();
        $select->whereEquals('deleted', true);
        $select->where(new Kwf_Model_Select_Expr_LowerEqual('last_change', new Kwf_Date('-1 months')));
        return $select;
    }

    public function hasWorkload()
    {
        return Kwf_Model_Abstract::getInstance('Speakers')->countRows($this->_getSelect());
    }

    public function execute($debug)
    {
        $speakersModel = Kwf_Model_Abstract::getInstance('Speakers');
        $db = Kwf_Registry::get('db');
        foreach ($speakersModel->getRows($this->_getSelect()) as $speakerRow) {
            $db->query("DELETE FROM t_speakers WHERE id = {$speakerRow->id};");
        }
    }
}
