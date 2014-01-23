<?php
class CircleGroups extends Kwf_Model_Db
{
    protected $_table = 't_circle_groups';
    protected $_toStringField = 'name';

    protected $_dependentModels = array(
        'Circles' => 'Circles'
    );
}
