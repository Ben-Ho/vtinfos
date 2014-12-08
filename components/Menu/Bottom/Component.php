<?php
class Menu_Bottom_Component extends Kwc_Menu_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['level'] = 'bottom';
        $ret['cssClass'] .= ' webListNone';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
