<?php
class Language_Component extends Kwc_Box_SwitchLanguage_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['separator'] = '';
        return $ret;
    }
}
