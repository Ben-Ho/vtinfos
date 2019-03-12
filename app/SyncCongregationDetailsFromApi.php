<?php
class SyncCongregationDetailsFromApi extends Kwf_Util_Maintenance_Job_Abstract
{
    protected $url = 'https://apps.jw.org/api/public/meeting-search/weekly-meetings/{org_g_uid}';
    public function getFrequency()
    {
        return Kwf_Util_Maintenance_Job_Abstract::FREQUENCY_DAILY;
    }

    private function _getSelect()
    {
        $select = new Kwf_Model_Select();
        $select->where(new Kwf_Model_Select_Expr_Not(new Kwf_Model_Select_Expr_IsNull('org_g_uid')));
        $select->where(new Kwf_Model_Select_Expr_Or(array(
            new Kwf_Model_Select_Expr_IsNull('last_sync'),
            new Kwf_Model_Select_Expr_LowerEqual('last_sync', new Kwf_Date('-6 months'))
        )));
        $select->limit(10);
        return $select;
    }

    public function hasWorkload()
    {
        return Kwf_Model_Abstract::getInstance('Congregations')->countRows($this->_getSelect());
    }

    public function execute($debug)
    {
        foreach (Kwf_Model_Abstract::getInstance('Congregations')->getRows($this->_getSelect()) as $congregationRow) {
            $client = new Zend_Http_Client(str_replace('{org_g_uid}', $congregationRow->org_g_uid, $this->url));
            $response = $client->request();
            $congregationData = json_decode($response->getBody(), true);
            if ($congregationData['properties']['orgGuid'] != $congregationRow->org_g_uid) {
                echo "$congregationRow->name, $congregationRow->id: Fehler 1.\n";
                continue;
            }
            if ($congregationData['properties']['orgType'] != 'CONG') {
                echo "$congregationRow->name, $congregationRow->id: Fehler 2.\n";
                continue;
            }
            $congregationRow->name = $congregationData['properties']['orgName'];
            $congregationRow->latitude = $congregationData['location']['latitude'];
            $congregationRow->longitude = $congregationData['location']['longitude'];
            $congregationRow->longitude = $congregationData['location']['longitude'];
            $addressString = $congregationData['properties']['address'];
            $addressParts = explode("\r\n", $addressString);
            if (count($addressParts) >= 2) {
                $congregationRow->street = $addressParts[0];
                $zipCity = explode(' ', $addressParts[1]);
                $congregationRow->zip = $zipCity[0];
                $congregationRow->city = $zipCity[1];
            }

            $congregationRow->talk_time = $this->_convertScheduleEntry($congregationData['properties']['schedule']['current']['weekend']);
            $congregationRow->ministryschool_time = $this->_convertScheduleEntry($congregationData['properties']['schedule']['current']['midweek']);
            // $congregationData['properties']['schedule']['futureDate']
            // $congregationData['properties']['languageCode']

            $congregationRow->last_sync = date('Y-m-d H:i:s');
            $congregationRow->save();
        }
    }

    private function _convertScheduleEntry($scheduleEntry)
    {
        $days = array('Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag');
        $dayText = $days[$scheduleEntry['weekday']-1];
        return $dayText.', '.$scheduleEntry['time'];
    }
}
