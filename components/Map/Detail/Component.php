<?php
class Map_Detail_Component extends Kwc_Directories_Item_Detail_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['child']['component']['drivetime'] = 'Map_Detail_Drivetime_Component';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
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
