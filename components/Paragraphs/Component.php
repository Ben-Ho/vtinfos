<?php
class Paragraphs_Component extends Kwc_Paragraphs_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
