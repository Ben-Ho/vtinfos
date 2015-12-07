<?php
class Rows_Speaker extends Kwf_Model_Db_Row
{
    public function __toString()
    {
        return $this->_row->lastname.' '.$this->_row->firstname;
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();
        $this->last_change = date('Y-m-d H:i:s');
    }
}
