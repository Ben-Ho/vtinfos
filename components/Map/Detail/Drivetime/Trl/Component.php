<?php
class Map_Detail_Drivetime_Trl_Component extends Kwc_Chained_Trl_Component
{
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['componentId'] = $this->getData()->componentId;
        if (isset($ret['travelTime'])) {
            $ret['travelTime'] = str_replace('Stunden', $this->getData()->trl('Stunden'),
                                    str_replace('Minuten', $this->getData()->trl('Minuten'),
                                        $ret['travelTime']));
        }
        return $ret;
    }
}
