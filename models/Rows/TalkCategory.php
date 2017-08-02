<?php
class Rows_TalkCategory extends Kwf_Model_Db_Row
{


    public function getCategoryTitle($language)
    {
        $select = new Kwf_Model_Select();
        $select->whereEquals('language', $language);
        $select->limit(1);
        $rows = $this->getChildRows('TalkCategoryTitles', $select);
        if (count($rows) == 0) {
            return $this->title;
        } else {
            return $rows[0]->title;
        }
    }
}
