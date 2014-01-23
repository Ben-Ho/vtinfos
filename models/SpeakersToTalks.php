<?php
class SpeakersToTalks extends Kwf_Model_Db
{
    protected $_table = 't_speakers_to_talks';

    protected $_referenceMap = array(
        'Speaker' => array(
            'refModelClass' => 'Speakers',
            'column' => 'speaker_id'
        ),
        'Talk' => array(
            'refModelClass' => 'Talks',
            'column' => 'talk_id'
        )
    );

    protected function _init()
    {
        parent::_init();
        $this->_exprs['title'] = new Kwf_Model_Select_Expr_Parent('Talk', 'title');
        $this->_exprs['number'] = new Kwf_Model_Select_Expr_Parent('Talk', 'number');
    }
}
