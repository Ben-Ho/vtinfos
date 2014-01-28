<?php
class Talks_Events extends Kwf_Component_Abstract_Events
{
    public function getListeners()
    {
        $ret = array();
        $ret[] = array(
            'class' => 'Talks',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'Talks',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'Talks',
            'event' => 'Kwf_Component_Event_Row_Deleted',
            'callback' => 'onRowChanged'
        );
        return $ret;
    }

    public function onRowChanged(Kwf_Component_Event_Row_Abstract $event)
    {
        $components = Kwf_Component_Data_Root::getInstance()
            ->getComponentsByClass('Talks_Component', array('ignoreVisible' => true));
        foreach ($components as $component) {
            $this->fireEvent(new Kwf_Component_Event_Component_ContentChanged(
            $component->componentClass, $component));
        }
    }
}
