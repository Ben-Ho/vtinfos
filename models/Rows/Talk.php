<?php
class Rows_Talk extends Kwf_Model_Db_Row
{
    public function __toString()
    {
        return $this->_row->number;
    }
}
