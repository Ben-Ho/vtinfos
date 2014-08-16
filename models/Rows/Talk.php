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
        return $rows[0]->title;
    }
}
