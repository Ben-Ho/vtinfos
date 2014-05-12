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

        $ret['editComponents'] = array('title', 'metaTags');

        $ret['contentWidth'] = 780;
        return $ret;
    }
}
