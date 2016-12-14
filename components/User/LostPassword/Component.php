<?php
class User_LostPassword_Component extends Kwc_User_LostPassword_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['flags']['resetMaster'] = true;
        $ret['generators']['setpass']['component'] = 'User_LostPassword_SetPassword_Component';
        return $ret;
    }
}
