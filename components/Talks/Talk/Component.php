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
        //TODO aktuellen status direkt bei vortrag ausgeben.
        //TODO removed: durchgestrichen, changed-title: icon: dreh-pfeil neben linie, changed-dispo: icon: dreh-pfeil mit sheet (nur halbes jahr lang anzeigen)
        $ret = parent::getTemplateVars($renderer);
        $ret['talkRow'] = $this->getData()->row;
        $ret['language'] = $this->getData()->getLanguage();
        return $ret;
    }
}
