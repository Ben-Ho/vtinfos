<?php
class Menu_Main_Component extends Kwc_Menu_Expanded_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['level'] = 'main';
        $ret['rootElementClass'] .= ' kwfUp-webListNone';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        foreach ($ret['menu'] as $k=>$m) {
            $ret['menu'][$k]['isFirstChildPage'] = is_instance_of($m['data'], 'Kwc_Basic_LinkTag_FirstChildPage_Data');
        }
        return $ret;
    }
}
