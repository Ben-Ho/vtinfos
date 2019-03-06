<?php
class TalksByCategory_Component extends Kwc_Abstract
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('Vortragsthemen nach Kategorien sortiert');
        $ret['rootElementClass'] = 'kwfUp-webStandard';

        $ret['generators']['talks'] = array(
            'component' => 'Talks_Talk_Component',
            'class' => 'Talks_TalkGenerator',
            'model' => 'Talks'
        );

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
            $select = new Kwf_Component_Select();
            $select->whereGenerator('talks');
            $childSelect = new Kwf_Model_Select();
            $childSelect->whereEquals('category_id', $talkCategoryRow->id);
            $select->where(new Kwf_Model_Select_Expr_Child_Contains('TalksToCategories', $childSelect));
            $select->order('number');

            $ret['categories'][] = array(
                'categoryTitle' => $talkCategoryRow->title,
                'talkComponents' => $this->getData()->getChildComponents($select)
            );
        }

        // nicht kategorisiert
        $select = new Kwf_Component_Select();
        $select->whereGenerator('talks');
        $select->where(new Kwf_Model_Select_Expr_Equal(new Kwf_Model_Select_Expr_Child_Count('TalksToCategories'), 0));
        $select->order('number');
        $ret['categories'][] = array(
            'categoryTitle' => trl('Nicht Kategorisiert'),
            'talkComponents' => $this->getData()->getChildComponents($select)
        );

        $ret['language'] = $this->getData()->getLanguage();
        return $ret;
    }
}
