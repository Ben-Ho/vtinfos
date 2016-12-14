<?php
class Title_Component extends Kwc_Abstract_Composite_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['child']['component']['menu'] = 'Menu_Main_Component';
        $ret['generators']['child']['component']['languages'] = 'Language_Component';
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['pageName'] = $this->getData()->getPage()->getRow()->name;
        return $ret;
    }
}
