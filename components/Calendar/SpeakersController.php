<?php
class Calendar_SpeakersController extends Kwf_Controller_Action
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
        $congregationId = $this->_getParam('congregationId');
        $congregationRow = Kwf_Model_Abstract::getInstance('Congregations')->getRow($congregationId);
        $speakers = array();
        foreach ($congregationRow->getChildRows('Speakers') as $speakerRow) {
            $speaker = array(
                'id' => $speakerRow->id,
                'name' => $speakerRow->name
            );
            $speaker['talks'] = array();
            foreach ($speakerRow->getChildRows('SpeakerToTalks') as $talkRow) {
                //TODO filtern nach richtiger sprache
                $speaker['talks'][] = array(
                    'number' => $talkRow->number,
                    'title' => $talkRow->title //TODO language
                );
            }
            if (count($speaker['talks'])) {
                $speakers[] = $speaker;
            }
        }
        echo json_encode(array(
            'speakers' => $speakers
        ));
        exit;
    }
}
