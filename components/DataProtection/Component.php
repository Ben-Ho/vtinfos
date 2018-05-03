<?php
class DataProtection_Component extends Kwc_Abstract_Composite_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['child']['component']['form'] = 'DataProtection_Form_Component';
        $ret['viewCache'] = false;
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $userRow = Kwf_Registry::get('userModel')->getAuthedUser();
        $ret['config'] = array(
            'dataProtectionAccepted' => !!$userRow->data_privacy
        );
        return $ret;
    }
}
