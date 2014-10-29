<?php
class CongregationAddresses extends Kwf_Model_Db
{
    protected $_table = 't_congregation_addresses';

    protected $_dependentModels = array(
        'Congregations' => 'Congregations'
    );
}
