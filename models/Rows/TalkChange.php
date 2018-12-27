<?php
class Rows_TalkChange extends Kwf_Model_Db_Row
{
    public function getDescription($language)
    {
        if ($this->change_type == 'removed') {
            return trl('Nicht mehr halten');
        } else if ($this->change_type == 'changed_title') {
            return trl('Titel geändert');
        } else if ($this->change_type == 'changed_dispo') {
            return trl('Disposition geändert');
        } else {
            return '';
        }
    }
}
