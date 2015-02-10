<?php
class Directories_Congregations_Detail_Events extends Kwc_Directories_Item_Detail_Events
{
    public function getListeners()
    {
        $ret = parent::getListeners();
        $ret[] = array(
            'class' => 'Speakers',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onSpeakerRowEvent'
        );
        $ret[] = array(
            'class' => 'Speakers',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onSpeakerRowEvent'
        );
        $ret[] = array(
            'class' => 'SpeakersToTalks',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onSpeakerToTalkRowEvent'
        );
        $ret[] = array(
            'class' => 'SpeakersToTalks',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onSpeakerToTalkRowEvent'
        );
        return $ret;
    }

    public function onSpeakerRowEvent(Kwf_Component_Event_Row_Abstract $event)
    {
        $this->_deleteCacheForCongregationId($event->row->congregation_id);
    }

    public function onSpeakerToTalkRowEvent(Kwf_Component_Event_Row_Abstract $event)
    {
        $this->_deleteCacheForCongregationId($event->row->getParentRow('Speaker')->congregation_id);
    }

    private function _deleteCacheForCongregationId($congregationId)
    {
        $component = Kwf_Component_Data_Root::getInstance()
            ->getComponentByDbId('congregations_'.$congregationId);
        $this->fireEvent(new Kwf_Component_Event_Component_ContentChanged('Directories_Congregations_Detail_Component', $component));
    }
}
