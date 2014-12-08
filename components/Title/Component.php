<?php
class Title_Component extends Kwc_Abstract_Composite_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['menu'] = 'Menu_Main_Component';
        $ret['cssClass'] = 'webStandard';
        $ret['assets']['dep'][] = 'KwfResponsiveEl';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['pageName'] = $this->getData()->getPage()->getRow()->name;
        return $ret;
    }
}
