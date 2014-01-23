<?php
class Menu_Main_Component extends Kwc_Menu_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['subMenu']['component'] = 'Menu_Main_Sub_Component';
        $ret['level'] = 'main';
        $ret['cssClass'] .= ' webListNone';
        $ret['assets']['dep'][] = 'KwfResponsiveEl';
        return $ret;
    }
}
