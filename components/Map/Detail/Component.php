<?php
class Map_Detail_Component extends Kwc_Directories_Item_Detail_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['drivetime'] = 'Map_Detail_Drivetime_Component';
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['congregations'] = array();
        foreach (explode(';', $this->getData()->row->congregationIds) as $congregationId) {
            if (!$congregationId) continue;
            $ret['congregations'][] = Kwf_Component_Data_Root::getInstance()->getComponentByDbId('congregations_'.$congregationId);
        }
        return $ret;
    }
}
