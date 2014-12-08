<?php
class Map_Detail_Trl_Component extends Kwc_Directories_Item_Detail_Trl_Component
{
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        foreach ($ret['congregations'] as $key => $congregation) {
            $ret['congregations'][$key] = Kwc_Chained_Trl_Component::getChainedByMaster($congregation, $this->getData());
        }
        return $ret;
    }
}
