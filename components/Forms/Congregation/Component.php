<?php
class Forms_Congregation_Component extends Kwc_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlStatic('Versammlungsformular');
        $ret['generators']['child']['component']['header'] = 'Forms_Congregation_Header_Component';
        $ret['hideFormOnSuccess'] = false;
        $ret['viewCache'] = false;
        $ret['placeholder']['submitButton'] = trlStatic('Speichern');
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        if ($user->congregation_id) {
            $this->getForm()->setId($user->congregation_id);
        }
        $ret = parent::getTemplateVars($renderer);
        return $ret;
    }
}
