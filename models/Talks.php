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
        return array('de', 'en', 'fr', 'zh', 'fa', 'gebaerde', 'twi', 'ga', 'tr', 'sr', 'ru', 'es', 'ar', 'tgl', 'hu','it', 'hi', 'en_pidgin');
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
        } else if ($code == 'twi') {
            if ($data) {
                return $data->trl('Twi');
            } else {
                return trlStatic('Twi');
            }
        } else if ($code == 'ga') {
            if ($data) {
                return $data->trl('Ga');
            } else {
                return trlStatic('Ga');
            }
        } else if ($code == 'tr') {
            if ($data) {
                return $data->trl('Türkisch');
            } else {
                return trlStatic('Türkisch');
            }
        } else if ($code == 'sr') {
            if ($data) {
                return $data->trl('Serbisch');
            } else {
                return trlStatic('Serbisch');
            }
        } else if ($code == 'ru') {
            if ($data) {
                return $data->trl('Russisch');
            } else {
                return trlStatic('Russisch');
            }
        } else if ($code == 'es') {
            if ($data) {
                return $data->trl('Spanisch');
            } else {
                return trlStatic('Spanisch');
            }
        } else if ($code == 'ar') {
            if ($data) {
                return $data->trl('Arabisch');
            } else {
                return trlStatic('Arabisch');
            }
        } else if ($code == 'hu') {
            if ($data) {
                return $data->trl('Ungarisch');
            } else {
                return trlStatic('Ungarisch');
            }
        } else if ($code == 'it') {
            if ($data) {
                return $data->trl('Italienisch');
            } else {
                return trlStatic('Italienisch');
            }
        } else if ($code == 'tgl') {
            if ($data) {
                return $data->trl('Tagalog');
            } else {
                return trlStatic('Tagalog');
            }
        } else if ($code == 'hi') {
            if ($data) {
                return $data->trl('Hindi');
            } else {
                return trlStatic('Hindi');
            }
        } else if ($code == 'en_pidgin') {
            if ($data) {
                return $data->trl('English-Pidgin');
            } else {
                return trlStatic('English-Pidgin');
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
