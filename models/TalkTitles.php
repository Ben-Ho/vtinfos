<?php
class TalkTitles extends Kwf_Model_Db
{
    protected $_table = 't_talk_titles';
    protected $_toStringField = 'title';

    protected $_referenceMap = array(
        'Talk' => array(
            'refModelClass' => 'Talks',
            'column' => 'talk_id'
        )
    );
}
