<?php
class Talks extends Kwf_Model_Db
{
    protected $_table = 't_talks';
    protected $_toStringField = 'title';
    protected $_rowClass = 'Rows_Talk';

    protected $_dependentModels = array(
        'TalkToSpeakers' => 'SpeakersToTalks',
        'TalkTitles' => 'TalkTitles'
    );

    public static function getLanguages()
    {
        return array('de', 'en', 'fr', 'zh', 'fa', 'gebaerde', 'twi', 'ga');
    }

    public static function getLanguage($code, $data = null)
    {
        if ($code == 'de') {
            if ($data) {
                return $data->trl('Deutsch');
            } else {
                return trlStatic('Deutsch');
            }
        } else if ($code == 'en') {
            if ($data) {
                return $data->trl('Englisch');
            } else {
                return trlStatic('Englisch');
            }
        } else if ($code == 'fr') {
            if ($data) {
                return $data->trl('Französisch');
            } else {
                return trlStatic('Französisch');
            }
        } else if ($code == 'zh') {
            if ($data) {
                return $data->trl('Chinesisch');
            } else {
                return trlStatic('Chinesisch');
            }
        } else if ($code == 'fa') {
        if ($data) {
                return $data->trl('Persisch');
            } else {
                return trlStatic('Persisch');
            }
        } else if ($code == 'gebaerde') {
            if ($data) {
                return $data->trl('Gebärdensprache');
            } else {
                return trlStatic('Gebärdensprache');
            }
        } else if ($code = 'twi') {
            if ($data) {
                return $data->trl('Twi');
            } else {
                return trlStatic('Twi');
            }
        } else if ($code = 'ga') {
            if ($data) {
                return $data->trl('Ga');
            } else {
                return trlStatic('Ga');
            }
        } else {
            if ($data) {
                return $data->trl('Unbekannt');
            } else {
                return trlStatic('Unbekannt');
            }
        }
    }
}
