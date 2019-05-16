<?php
class Talks_Talk_Component extends Kwc_Abstract
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        //TODO removed: durchgestrichen, changed-title: icon: dreh-pfeil neben linie, changed-dispo: icon: dreh-pfeil mit sheet (nur halbes jahr lang anzeigen)
        $ret = parent::getTemplateVars($renderer);
        $ret['talkRow'] = $this->getData()->row;
        $ret['language'] = $this->getData()->getLanguage();

        $ret['state'] = array();
        $ret['state']['removed'] = false;
        $ret['state']['specialTalk'] = false;
        $ret['state']['lastDispoChange'] = false;
        $ret['state']['existingSince'] = false;
        $talkChangeRows = $ret['talkRow']->getChanges();
        if (count($talkChangeRows)) {
            // Vortrag nicht mehr halten
            if ($talkChangeRows[0]->change_type == 'removed') {
                $ret['state']['removed'] = $talkChangeRows[0]->change_date;
            }
            // Sonderansprache
            foreach ($talkChangeRows as $talkChangeRow) {
                if ($talkChangeRow->change_type == 'special_talk') {
                    $ret['state']['specialTalk'] = $talkChangeRow->change_date;
                    break;
                }
            }
            // Letzte Dispo Änderung
            foreach ($talkChangeRows as $talkChangeRow) {
                if ($talkChangeRow->change_type == 'dispo_changed') {
                    $ret['state']['lastDispoChange'] = $talkChangeRow->change_date;
                    break;
                }
            }
            // Vortrag in Liste seit
            foreach ($talkChangeRows as $talkChangeRow) {
                if ($talkChangeRow->change_type == 'title_changed') {
                    $ret['state']['existingSince'] = $talkChangeRow->change_date;
                    break;
                }
            }
        }

        $stateIconMarkedAsNew = strtotime('-6 Months');
        $stateIconShowDispoChange = strtotime('-6 Months');

        $ret['stateClasses'] = '';
        if ($ret['state']['removed']) {
            $ret['stateClasses'] .= ' '.$ret['rootElementClass'].'--removed';
        }
        if ($ret['state']['specialTalk']) {
            $ret['stateClasses'] .= ' '.$ret['rootElementClass'].'--specialTalk';
        }
        if ($ret['state']['lastDispoChange'] && strtotime($ret['state']['lastDispoChange']) > $stateIconShowDispoChange) {
            $ret['stateClasses'] .= ' '.$ret['rootElementClass'].'--specialTalk';
        }
        if ($ret['state']['existingSince'] && strtotime($ret['state']['existingSince']) > $stateIconMarkedAsNew) {
            $ret['stateClasses'] .= ' ' . $ret['rootElementClass'] . '--specialTalk';
        }
        return $ret;
    }
}
