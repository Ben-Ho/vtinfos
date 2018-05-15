<?php
class Root_Component extends Kwc_Root_TrlRoot_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['master']['component'] = 'Root_Master_Component';
        $ret['generators']['chained']['component'] = 'Root_Chained_Component.Root_Master_Component';

        $ret['generators']['title']['component'] = 'Kwc_Box_TitleEditable_Component';
        $ret['childModel'] = new Kwc_Root_TrlRoot_Model(array(
                'de' => 'Deutsch',
                'en' => 'English'
        ));

        $ret['editComponents'] = array('title', 'metaTags');

        $ret['contentWidth'] = 780;
        $ret['assets']['files'][] = 'web/components/Root/Web.scss';
        return $ret;
    }

    public function getMasterTemplateVars(Kwf_Component_Data $innerComponent, Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getMasterTemplateVars($innerComponent, $renderer);
//        d($ret);
        return $ret;
    }
}
