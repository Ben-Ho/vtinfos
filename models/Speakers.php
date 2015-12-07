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
        $this->_exprs['circle_name'] = new Kwf_Model_Select_Expr_Parent('Congregation', 'circle_name');
        $this->_exprs['name'] = new Kwf_Model_Select_Expr_Concat(array(
            new Kwf_Model_Select_Expr_Field('lastname'),
            new Kwf_Model_Select_Expr_String(' '),
            new Kwf_Model_Select_Expr_Field('firstname')
        ));
        $this->_exprs['group_id'] = new Kwf_Model_Select_Expr_Parent('Congregation', 'group_id');
        $this->_exprs['phone_normalized'] = new Kwf_Model_Select_Expr_Sql("REPLACE(phone, ' ', '')");
        $this->_exprs['phone2_normalized'] = new Kwf_Model_Select_Expr_Sql("REPLACE(phone2, ' ', '')");
        $select = new Kwf_Model_Select();
        $select->order('last_change', 'DESC');
        $this->_exprs['talks_last_change'] = new Kwf_Model_Select_Expr_Child_First('SpeakerToTalks', 'last_change', $select);
        $this->_exprs['speaker_last_change'] = new Kwf_Model_Select_Expr_If(
            new Kwf_Model_Select_Expr_Higher('talks_last_change', new Kwf_Model_Select_Expr_Field('last_change')),
            new Kwf_Model_Select_Expr_Field('talks_last_change'),
            new Kwf_Model_Select_Expr_Field('last_change')
        );
    }
}
