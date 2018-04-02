<?php
class Login_Component extends Kwc_User_Login_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['child']['component']['form'] = 'Login_Form_Component';
        $ret['generators']['box'] = array(
            'class' => 'Kwf_Component_Generator_Box_Static',
            'component' => array(
                'logo' => 'Logo_Component'
            ),
            'inherit' => true,
            'priority' => 0
        );
        $ret['flags']['resetMaster'] = true;
        $ret['assets']['files'][] = 'web/components/Login/Master.scss';
        return $ret;
    }
}
