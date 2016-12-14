<?php
class User_LostPassword_SetPassword_Component extends Kwc_User_LostPassword_SetPassword_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        return $ret;
    }
}
