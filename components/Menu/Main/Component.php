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
}
