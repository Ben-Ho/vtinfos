<?php
class Rows_Talk extends Kwf_Model_Db_Row
{
    public function __toString()
    {
        return $this->_row->number;
    }

    public function getTitle($language)
    {
        $select = new Kwf_Model_Select();
        $select->whereEquals('language', $language);
        $select->limit(1);
        $rows = $this->getChildRows('TalkTitles', $select);
        if (count($rows) == 0) {
            return $this->title;
        } else {
            return $rows[0]->title;
        }
    }

    public function getChanges()
    {
        // removed: durchgestrichen, changed-title: icon: dreh-pfeil neben linie, changed-dispo: icon: dreh-pfeil mit sheet (nur halbes jahr lang anzeigen)
        // change-types: removed, changed-title, changed-dispo, special-talk
        $select = new Kwf_Model_Select();
        $select->order('change_date', 'DESC');
        $changeRows = array();
        foreach ($this->getChildRows('TalkChanges', $select) as $changeRow) {
            if ($changeRow->change_type == 'title_changed') {
                $changeRows[] = $changeRow;
                break; // änderung des titels macht vortrag zu einem neuen => alle nachfolgenden änderungen nicht mehr relevant
            }
            $changeRows[] = $changeRow;
        }
        return $changeRows;
    }
}
