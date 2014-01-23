<?php
class Talks extends Kwf_Model_Db
{
    protected $_table = 't_talks';
    protected $_toStringField = 'title';
    protected $_rowClass = 'Rows_Talk';

    protected $_dependentModels = array(
        'TalkToSpeakers' => 'SpeakersToTalks'
    );
}
