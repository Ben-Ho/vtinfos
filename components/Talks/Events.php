<?php
class Talks_Events extends Kwf_Component_Abstract_Events
{
    public function getListeners()
    {
        $ret = parent::getListeners();
        $ret[] = array(
            'class' => 'Talks',
            'event' => 'Kwf_Events_Event_Row_Updated',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'Talks',
            'event' => 'Kwf_Events_Event_Row_Inserted',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'Talks',
            'event' => 'Kwf_Events_Event_Row_Deleted',
            'callback' => 'onRowChanged'
        );
        return $ret;
    }

    public function onRowChanged(Kwf_Events_Event_Row_Abstract $event)
    {
        $this->fireEvent(new Kwf_Component_Event_ComponentClass_ContentChanged($this->_class));
    }
}
