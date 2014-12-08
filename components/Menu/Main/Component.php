<?php
class Menu_Main_Component extends Kwc_Menu_Expanded_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['level'] = 'main';
        $ret['cssClass'] .= ' webListNone';
        $ret['assets']['dep'][] = 'KwfResponsiveEl';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
