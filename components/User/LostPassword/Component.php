<?php
class User_LostPassword_Component extends Kwc_User_LostPassword_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['flags']['resetMaster'] = true;
        $ret['generators']['setpass']['component'] = 'User_LostPassword_SetPassword_Component';
        return $ret;
    }
}
