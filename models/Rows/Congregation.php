<?php
class Rows_Congregation extends Kwf_Model_Db_Row
{
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $this->last_change = date('Y-m-d H:i:s');
    }
}
