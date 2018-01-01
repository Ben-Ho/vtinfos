<?php
class Search_Component extends Kwc_Abstract
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['componentName'] = trlStatic('React Suche');
        //TODO button "Auswahl als Standard speichern" im local-storage (mit Distance=50 als default)
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['config'] = array();
        $ret['config']['settings'] = array();
        $ret['config']['settings']['responseLanguage'] = $this->getData()->getLanguage();

        $ret['config']['talkLanguages'] = array();
        foreach (Talks::getLanguages() as $code) {
            $ret['config']['talkLanguages'][$code] = Talks::getLanguage($code, $this->getData());
        }
        $ret['config']['circleGroups'] = array();
        $select = new Kwf_Model_Select();
        $select->order('name', 'ASC');
        foreach (Kwf_Model_Abstract::getInstance('CircleGroups')->getRows($select) as $circleGroupRow) {
            $circles = array();
            foreach ($circleGroupRow->getChildRows('Circles', $select) as $circleRow) {
                $congregations = array();
                foreach ($circleRow->getChildRows('Congregations', $select) as $congregationRow) {
                    $congregations[$congregationRow->id] = $congregationRow->name;
                }
                $circles['c_'.$circleRow->id] = array(
                    'name' => $circleRow->name,
                    'congregations' => $congregations
                );
            }
            $ret['config']['circleGroups']['g_'.$circleGroupRow->id] = array(
                'name' => $circleGroupRow->name,
                'circles' => $circles
            );
        }
        return $ret;
    }
}
