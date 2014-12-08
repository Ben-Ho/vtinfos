<?php
class Search_Speakers_Detail_Trl_Component extends Kwc_Directories_Item_Detail_Trl_Component
{
    public static function getSettings($masterComponentClass)
    {
        $ret = parent::getSettings($masterComponentClass);
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $congregationMaster = Kwf_Component_Data_Root::getInstance()
            ->getComponentByDbId('congregations_'.$this->getData()->chained->row->congregation_id);
        $ret['congregation'] = Kwc_Chained_Trl_Component::getChainedByMaster($ret['congregation'], $this->getData());
        foreach ($ret['talks'] as $key => $talk) {
            $ret['talks'][$key]['title']
                = $talk['row']->getParentRow('Talk')->getTitle($this->getData()->getLanguage());
        }
        return $ret;
    }
}
