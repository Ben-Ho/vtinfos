<?php
class Circles_Circle_Congregation_Events extends Kwf_Component_Abstract_Events
{
    public function getListeners()
    {
        $ret = array();
        $ret[] = array(
            'class' => 'Congregations',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onRowChangedCongregation'
        );
        $ret[] = array(
            'class' => 'Congregations',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onRowChangedCongregation'
        );
        $ret[] = array(
            'class' => 'Congregations',
            'event' => 'Kwf_Component_Event_Row_Deleted',
            'callback' => 'onRowChangedCongregation'
        );

        $ret[] = array(
            'class' => 'Speakers',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onRowChangedSpeakers'
        );
        $ret[] = array(
            'class' => 'Speakers',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onRowChangedSpeakers'
        );
        $ret[] = array(
            'class' => 'Speakers',
            'event' => 'Kwf_Component_Event_Row_Deleted',
            'callback' => 'onRowChangedSpeakers'
        );

        $ret[] = array(
            'class' => 'Talks',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onRowChangedTalks'
        );
        $ret[] = array(
            'class' => 'Talks',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onRowChangedTalks'
        );
        $ret[] = array(
            'class' => 'Talks',
            'event' => 'Kwf_Component_Event_Row_Deleted',
            'callback' => 'onRowChangedTalks'
        );

        $ret[] = array(
            'class' => 'SpeakersToTalks',
            'event' => 'Kwf_Component_Event_Row_Updated',
            'callback' => 'onRowChangedSpeakersToTalks'
        );
        $ret[] = array(
            'class' => 'SpeakersToTalks',
            'event' => 'Kwf_Component_Event_Row_Inserted',
            'callback' => 'onRowChangedSpeakersToTalks'
        );
        $ret[] = array(
            'class' => 'SpeakersToTalks',
            'event' => 'Kwf_Component_Event_Row_Deleted',
            'callback' => 'onRowChangedSpeakersToTalks'
        );
        return $ret;
    }

    public function onRowChangedCongregation(Kwf_Component_Event_Row_Abstract $event)
    {
        $components = Kwf_Component_Data_Root::getInstance()
            ->getComponentsByClass('Circles_Circle_Component', array('ignoreVisible' => true));
        foreach ($components as $component) {
            $congregationComponents = $component->getChildComponents(array('componentClass' => 'Circles_Circle_Congregation_Component'));
            foreach ($congregationComponents as $congregationComponent) {
                if ($congregationComponent->getRow()->id == $event->row->id) {
                    $this->fireEvent(new Kwf_Component_Event_Component_ContentChanged(
                        $congregationComponent->componentClass,
                        $congregationComponent));
                    $this->fireEvent(new Kwf_Component_Event_Component_HasContentChanged(
                        $congregationComponent->componentClass, $congregationComponent
                    ));
                }
            }
        }
    }

    public function onRowChangedSpeakers(Kwf_Component_Event_Row_Abstract $event)
    {
        $components = Kwf_Component_Data_Root::getInstance()
            ->getComponentsByClass('Circles_Circle_Component', array('ignoreVisible' => true));
        foreach ($components as $component) {
            $congregationComponents = $component->getChildComponents(array('componentClass' => 'Circles_Circle_Congregation_Component'));
            foreach ($congregationComponents as $congregationComponent) {
                if ($congregationComponent->getRow()->id == $event->row->congregation_id) {
                    $this->fireEvent(new Kwf_Component_Event_Component_ContentChanged(
                        $congregationComponent->componentClass,
                        $congregationComponent));
                }
            }
        }
    }

    public function onRowChangedTalks(Kwf_Component_Event_Row_Abstract $event)
    {
        $components = Kwf_Component_Data_Root::getInstance()
            ->getComponentsByClass('Circles_Circle_Component', array('ignoreVisible' => true));
        foreach ($components as $component) {
            $congregationComponents = $component->getChildComponents(array('componentClass' => 'Circles_Circle_Congregation_Component'));
            foreach ($congregationComponents as $congregationComponent) {
                foreach ($congregationComponent->getRow()->getChildRows('Speakers') as $speaker) {
                    $select = new Kwf_Model_Select();
                    $select->where(new Kwf_Model_Select_Expr_Contains('speaker_id', $speaker->id));
                    $speakers = $event->row->getChildRows('TalkToSpeakers', $select);
                    if (count($speakers) > 0) {
                        $this->fireEvent(new Kwf_Component_Event_Component_ContentChanged(
                            $congregationComponent->componentClass,
                            $congregationComponent));
                        break;
                    }
                }
            }
        }
    }

    public function onRowChangedSpeakersToTalks(Kwf_Component_Event_Row_Abstract $event)
    {
        $components = Kwf_Component_Data_Root::getInstance()
            ->getComponentsByClass('Circles_Circle_Component', array('ignoreVisible' => true));
        foreach ($components as $component) {
            $congregationComponents = $component->getChildComponents(array('componentClass' => 'Circles_Circle_Congregation_Component'));
            foreach ($congregationComponents as $congregationComponent) {
                if ($event->row->getParentRow('Speaker')->congregation_id == $congregationComponent->getRow()->id) {
                    $this->fireEvent(new Kwf_Component_Event_Component_ContentChanged(
                        $congregationComponent->componentClass,
                        $congregationComponent));
                }
            }
        }
    }
}
