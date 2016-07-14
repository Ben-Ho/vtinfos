<?php
class Calendar_DatesController extends Kwf_Controller_Action
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
        $userRow = Kwf_Registry::get('userModel')->getAuthedUser();

        $startDate = $this->_getParam('startDate');
        $limit = $this->_getParam('limit', 10);
        $startDay = date('Y-m-d', strtotime($startDate));
        $weeks = array();
        for ($i = 0; $i < $limit; $i++) {
            $date = strtotime($startDay.' + '.$i.' Weeks');
            $weeks[] = array(
                'date' => date('Y-W', $date),
                'monday' => date('d.m.Y', strtotime('monday this week', $date)),
                'month' => date('m', $date),
                'speaker_id' => '',
                'speaker' => '',
                'talk_id' => '',
                'talk' => ''
            );
        }
        foreach ($weeks as &$week) {
            $select = new Kwf_Model_Select();
            $select->whereEquals('week', $week['date']);
            $select->whereEquals('congregation_id', $userRow->congregation_id);
            $weekRow = Kwf_Model_Abstract::getInstance('Calendar_SpeakerToWeekModel')->getRow($select);
            if ($weekRow) {
                $week['speaker_id'] = $weekRow->speaker_id;
                $week['talk_id'] = $weekRow->talk_id;
                $week['speaker'] = $weekRow->getParentRow('Speaker')->name;
                $week['talk'] = $weekRow->getParentRow('Talk')->number.' '.$weekRow->getParentRow('Talk')->title;
            }
        }
        echo json_encode(array(
            'weeks' => $weeks
        ));
        exit;
    }

    public function saveAction()
    {
        $talkId = $this->_getParam('talkId');
        $speakerId = $this->_getParam('speakerId');
        $week = $this->_getParam('week');
        if (!$talkId || !$speakerId || !$week) throw new Kwf_Exception('Missing parameter');

        $userRow = Kwf_Registry::get('userModel')->getAuthedUser();
        $select = new Kwf_Model_Select();
        $select->whereEquals('week', $week);
        $select->whereEquals('congregation_id', $userRow->congregation_id);
        $weekRow = Kwf_Model_Abstract::getInstance('Calendar_SpeakerToWeekModel')->getRow($select);
        if (!$weekRow) {
            $weekRow = Kwf_Model_Abstract::getInstance('Calendar_SpeakerToWeekModel')->createRow();
            $weekRow->week = $week;
            $weekRow->congregation_id = $userRow->congregation_id;
        }
        $weekRow->speaker_id = $speakerId;
        $weekRow->talk_id = $talkId;
        $weekRow->save();
        $week =  array(
            'date' => $week,
            'monday' => date('d.m.Y', strtotime('monday this week', strtotime($week))),
            'month' => date('m', strtotime($week)),
            'speaker' => '',
            'talk_id' => $weekRow->talk_id,
            'talk' => $weekRow->getParentRow('Talk')->number.' '.$weekRow->getParentRow('Talk')->title,
            'speaker' => $weekRow->getParentRow('Speaker')->name,
            'speaker_id' => $weekRow->speaker_id
        );
        echo json_encode(array(
            'result' => 'OK',
            'week' => $week
        ));
        exit;
    }
}
