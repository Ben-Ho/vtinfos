<?php
class Paragraphs_Component extends Kwc_Paragraphs_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }
}
