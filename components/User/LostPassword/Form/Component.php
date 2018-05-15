<?php
class User_LostPassword_Form_Component extends Kwc_User_LostPassword_Form_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['decorator'] = 'Form_Decorator_FloatLabel';
        return $ret;
    }
}