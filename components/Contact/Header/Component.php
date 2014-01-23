<?php
class Contact_Header_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['viewCache'] = false;
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        $ret['firstname'] = $user->firstname;
        $ret['lastname'] = $user->lastname;
        $ret['email'] = $user->email;
        return $ret;
    }
}
