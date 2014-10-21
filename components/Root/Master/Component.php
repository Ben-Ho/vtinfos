<?php
class Root_Master_Component extends Kwc_Root_TrlRoot_Master_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['box']['component']['title'] = 'Title_Component';
        $ret['generators']['box']['component']['bottomMenu'] = 'Menu_Bottom_Component';
        $ret['generators']['box']['component']['metaTags'] = 'Kwc_Box_MetaTagsContent_Component';

        $ret['generators']['languageSwitcher'] = array(
            'class' => 'Kwf_Component_Generator_Box_Static',
            'component' => 'Language_Component',
            'inherit' => true
       );

        $ret['generators']['login'] = array(
            'class' => 'Kwf_Component_Generator_Page_Static',
            'component' => 'Login_Component',
            'name' => trlStatic('Login'),
            'inherit' => false,
            'unique' => true
        );

        $ret['editComponents'] = array('metaTags', 'flag');
        return $ret;
    }
}

