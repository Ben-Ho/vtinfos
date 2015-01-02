<?php
class Language_Component extends Kwc_Box_SwitchLanguage_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['separator'] = '';
        return $ret;
    }
}
