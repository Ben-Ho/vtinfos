<?php
class Root_Master_Component extends Kwc_Root_TrlRoot_Master_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        unset($ret['generators']['flag']);
        unset($ret['generators']['box']['component']['switchLanguage']);

        $ret['generators']['box']['component']['metaTags'] = 'Kwc_Box_MetaTagsContent_Component';

        $ret['generators']['login'] = array(
            'class' => 'Kwf_Component_Generator_Page_Static',
            'component' => 'Login_Component',
            'name' => 'Login',
            'inherit' => false,
            'unique' => true
        );

        $ret['generators']['lostPassword'] = array(
            'class' => 'Kwf_Component_Generator_Page_Static',
            'component' => 'User_LostPassword_Component',
            'name' => trlKwfStatic('Passwort vergessen'),
            'inherit' => false,
            'unique' => true
        );

        $ret['editComponents'] = array();
        return $ret;
    }
}

