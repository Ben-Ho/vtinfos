<?php
class Root_Component extends Kwc_Root_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();

        $ret['generators']['box']['component']['mainMenu'] = 'Menu_Main_Component';
        $ret['generators']['box']['component']['subMenu'] = 'Menu_Sub_Component';
        $ret['generators']['box']['component']['bottomMenu'] = 'Menu_Bottom_Component';
        $ret['generators']['box']['component']['metaTags'] = 'Kwc_Box_MetaTagsContent_Component';

        $ret['generators']['title']['component'] = 'Kwc_Box_TitleEditable_Component';

        $ret['generators']['login'] = array(
            'class' => 'Kwf_Component_Generator_Page_Static',
            'component' => 'Login_Component',
            'name' => trlStatic('Login'),
            'inherit' => false,
            'unique' => true
        );

        $ret['editComponents'] = array('title', 'metaTags');

        $ret['contentWidth'] = 780;
//         $ret['contentWidthBoxSubtract'] = array(
//             'subMenu' => 205,
//         );
        return $ret;
    }
}
