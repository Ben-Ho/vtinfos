<?php
class Login_Trl_Component extends Kwc_User_Login_Trl_Component
{
    public static function getSettings($masterComponentClass = null)
    {
        $ret = parent::getSettings($masterComponentClass);
        return $ret;
    }
}
