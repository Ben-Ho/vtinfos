<?php
class Calendar_TalksController extends Kwf_Controller_Action
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
        $speakerRow = Kwf_Model_Abstract::getInstance('Speakers')->getRow($this->_getParam('speakerId'));
        $talks = array();
        foreach ($speakerRow->getChildRows('SpeakerToTalks') as $talkRow) {
            $talks[] = array(
                'id' => $talkRow->talk_id,
                'number' => $talkRow->number,
                'title' => $talkRow->title //TODO language
            );
        }
        echo json_encode(array(
            'talks' => $talks
        ));
        exit;
    }
}
