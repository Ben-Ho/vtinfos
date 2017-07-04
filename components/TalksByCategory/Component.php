<?php
class TalksByCategory_Component extends Kwc_Abstract
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('Vortragsthemen nach Kategorien sortiert');
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $select = new Kwf_Model_Select();
        $select->order('title');
        $ret['categories'] = array();
        foreach (Kwf_Model_Abstract::getInstance('TalkCategories')->getRows($select) as $talkCategoryRow) {
            $talks = array();
            foreach ($talkCategoryRow->getChildRows('TalksToCategories') as $talkRelationRow) {
                $talks[] = $talkRelationRow->getParentRow('Talk');
            }
            $ret['categories'][] = array(
                'categoryRow' => $talkCategoryRow,
                'talks' => $talks
            );
        }
        $ret['language'] = $this->getData()->getLanguage();
        return $ret;
    }
}
