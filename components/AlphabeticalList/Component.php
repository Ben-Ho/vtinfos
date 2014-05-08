<?php
class AlphabeticalList_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Versammlungen A-Z');
        $ret['childModel'] = 'Congregations';
        $ret['cssClass'] = 'webStandard';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['congregations'] = Kwf_Component_Data_Root::getInstance()
            ->getComponentByClass('Directories_Congregations_Component');
        return $ret;
    }
}
