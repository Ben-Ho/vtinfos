<?php
class Circles_Circle_Events extends Kwf_Component_Abstract_Events
{
    public function getListeners()
    {
        $ret = array();
        $ret[] = array(
            'class' => 'Congregations',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'Congregations',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onRowChanged'
        );
        $ret[] = array(
            'class' => 'Congregations',
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
            $circleComponents = $component->getChildComponents(array('componentClass' => 'Circles_Circle_Component'));
            foreach ($circleComponents as $circleComponent) {
                if ($circleComponent->getRow()->id == $event->row->circle_id) {
                    $this->fireEvent(new Kwf_Component_Event_Component_ContentChanged(
                        $circleComponent->componentClass, $circleComponent));
                }
            }
        }
    }
}
