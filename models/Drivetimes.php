<?php
class Drivetimes extends Kwf_Model_Db
{
    protected $_table = 't_drivetimes';

    protected $_referenceMap = array(
        'Congregation1' => array(
            'refModelClass' => 'Congregations',
            'column' => 'congregation1_id'
        ),
        'Congregation2' => array(
            'refModelClass' => 'Congregations',
            'column' => 'congregation2_id'
        )
    );
}
