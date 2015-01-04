<?php
class Speakers extends Kwf_Model_Db
{
    protected $_table = 't_speakers';
    protected $_rowClass = 'Rows_Speaker';

    protected $_referenceMap = array(
        'Congregation' => array(
            'refModelClass' => 'Congregations',
            'column' => 'congregation_id'
        )
    );

    protected $_dependentModels = array(
        'SpeakerToTalks' => 'SpeakersToTalks'
    );

    protected function _init()
    {
        parent::_init();
        $this->_exprs['speaks_count'] = new Kwf_Model_Select_Expr_Child_Count('SpeakerToTalks', new Kwf_Model_Select());
        $this->_exprs['longitude'] = new Kwf_Model_Select_Expr_Parent('Congregation', 'longitude');
        $this->_exprs['latitude'] = new Kwf_Model_Select_Expr_Parent('Congregation', 'latitude');
        $this->_exprs['circle_id'] = new Kwf_Model_Select_Expr_Parent('Congregation', 'circle_id');
    }
}
