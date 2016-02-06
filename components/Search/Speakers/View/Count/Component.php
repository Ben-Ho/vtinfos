<?php
class Search_Speakers_View_Count_Component extends Kwc_Directories_List_View_Count_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['placeholder']['total'] = trlStatic('Suchergebnisse').': ';
        return $ret;
    }
}

