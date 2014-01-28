<?php
class Circles_Events extends Kwf_Component_Abstract_Events
{
    public function getListeners()
    {
        $ret = array();
        $ret[] = array(
            'class' => 'Circles',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'Circles',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'Circles',
            'event' => 'Kwf_Component_Event_Row_Deleted',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'CircleGroups',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'CircleGroups',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'CircleGroups',
            'event' => 'Kwf_Component_Event_Row_Deleted',
            'callback' => 'onRowChanged'
        );
        return $ret;
    }

    public function onRowChanged(Kwf_Component_Event_Row_Abstract $event)
    {
        $components = Kwf_Component_Data_Root::getInstance()
            ->getComponentsByClass('Circles_Component', array('ignoreVisible' => true));
        foreach ($components as $component) {
            $this->fireEvent(new Kwf_Component_Event_Component_ContentChanged(
            $component->componentClass, $component));
        }
    }
}
