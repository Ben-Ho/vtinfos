<?php
class Congregations extends Kwf_Model_Db
{
    protected $_table = 't_congregations';
    protected $_toStringField = 'name';
    protected $_rowClass = 'Rows_Congregation';


    protected $_referenceMap = array(
        'Circle' => array(
            'refModelClass' => 'Circles',
            'column' => 'circle_id'
        ),
        'TalkOrganiser' => array(
            'refModelClass' => 'Speakers',
            'column' => 'talk_organiser'
        ),
        'Coordinator' => array(
            'refModelClass' => 'Speakers',
            'column' => 'coordinator'
        )
    );

    protected $_dependentModels = array(
        'Speakers' => 'Speakers',
        'Drivetimes' => 'Drivetimes'
    );

    protected $_serialization = array(
        'name' => 'rest_read',
    );

    protected function _init()
    {
        parent::_init();
        $this->_exprs['circle_name'] = new Kwf_Model_Select_Expr_Parent('Circle', 'name');
        $this->_exprs['group_id'] = new Kwf_Model_Select_Expr_Parent('Circle', 'group_id');
        $select = new Kwf_Model_Select();
        $select->expr('speaker_last_change');
        $select->order('speaker_last_change', 'DESC');
        $this->_exprs['speakers_last_change'] = new Kwf_Model_Select_Expr_Child_First('Speakers', 'speaker_last_change', $select);
        $this->_exprs['congregation_last_change'] = new Kwf_Model_Select_Expr_If(
            new Kwf_Model_Select_Expr_Higher('speakers_last_change', new Kwf_Model_Select_Expr_Field('last_change')),
            new Kwf_Model_Select_Expr_Field('speakers_last_change'),
            new Kwf_Model_Select_Expr_Field('last_change')
        );
    }
}
