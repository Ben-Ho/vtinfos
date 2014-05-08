<?php
class Root_Component extends Kwc_Root_TrlRoot_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['master']['component'] = 'Root_Master_Component';
        $ret['generators']['chained']['component'] = 'Root_Chained_Component.Root_Master_Component';

        $ret['generators']['title']['component'] = 'Kwc_Box_TitleEditable_Component';
        $ret['childModel'] = new Kwc_Root_TrlRoot_Model(array(
                'de' => 'Deutsch',
                'en' => 'English'
        ));

        $ret['generators']['login'] = array(
            'class' => 'Kwf_Component_Generator_Page_Static',
            'component' => 'Login_Component',
            'name' => trlStatic('Login'),
            'inherit' => false,
            'unique' => true
        );
        $ret['generators']['congregations'] = array(
            'class' => 'Kwf_Component_Generator_Page_Static',
            'component' => 'Directories_Congregations_Component',
            'name' => trlStatic('Versammlungen')
        );

        $ret['editComponents'] = array('title', 'metaTags');

        $ret['contentWidth'] = 780;
        return $ret;
    }
}
