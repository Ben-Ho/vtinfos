<?php
class CircleGroups extends Kwf_Model_Db
{
    protected $_table = 't_circle_groups';
    protected $_toStringField = 'name';

    protected $_dependentModels = array(
        'Circles' => 'Circles'
    );

    protected $_serialization = array(
        'name' => 'rest_read',
        'circles' => array(
            'type' => '\KwfBundle\Serializer\KwfModel\ColumnNormalizer\ChildRows',
            'rule' => 'Circles',
            'child_groups' => array('rest_read'),
            'groups' => 'rest_read'
        )
    );
}
