<?php
class Circles_Trl_Component extends Kwc_Chained_Trl_Component
{
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        foreach ($ret['circles'] as $circle => $congregations) {
            foreach ($congregations as $key => $congregation) {
                $ret['circles'][$circle][$key]
                    = Kwc_Chained_Trl_Component::getChainedByMaster($ret['circles'][$circle][$key], $this->getData());
            }
        }
        return $ret;
    }
}
