<?php
class TalkChanges extends Kwf_Model_Db
{
    protected $_table = 't_talk_changes';

    protected function _init()
    {
        parent::_init();
        $this->_referenceMap['Talk'] = array(
            'refModelClass' => 'Talks',
            'column' => 'talk_id'
        );
    }
}
