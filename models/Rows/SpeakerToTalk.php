<?php
class Rows_SpeakerToTalk extends Kwf_Model_Db_Row
{
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $this->last_change = date('Y-m-d H:i:s');
    }
}
