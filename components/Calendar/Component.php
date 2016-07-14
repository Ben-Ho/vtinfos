<?php
class Calendar_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Kalender');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['config'] = array(
            'controllerUrl' => Kwc_Admin::getInstance($this->getData()->componentClass)->getControllerUrl('Dates'),
            'componentId' => $this->getData()->componentId,
            'congregationsUrl' => Kwc_Admin::getInstance($this->getData()->componentClass)
                ->getControllerUrl('Congregations'),
            'speakersUrl' => Kwc_Admin::getInstance($this->getData()->componentClass)
                ->getControllerUrl('Speakers'),
            'talksUrl' => Kwc_Admin::getInstance($this->getData()->componentClass)
                ->getControllerUrl('Talks')
        );
        return $ret;
    }
}
