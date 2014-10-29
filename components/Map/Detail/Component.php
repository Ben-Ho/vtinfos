<?php
class Map_Detail_Component extends Kwc_Directories_Item_Detail_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['congregations'] = array();
        foreach ($this->getData()->getRow()->getChildRows('Congregations') as $congregation) {
            //FIXME get congregation_component by dbId and link there
            $ret['congregations'][] = Kwf_Component_Data_Root::getInstance();
        }
        return $ret;
    }
}
