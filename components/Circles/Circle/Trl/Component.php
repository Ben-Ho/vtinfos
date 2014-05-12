<?php
class Circles_Circle_Trl_Component extends Kwc_Chained_Trl_Component
{
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        foreach ($ret['congregations'] as $key => $congregation) {
            $ret['congregations'][$key]
                = Kwc_Chained_Trl_Component::getChainedByMaster($ret['congregations'][$key], $this->getData());
        }
        return $ret;
    }
}
