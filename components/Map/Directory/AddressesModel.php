<?php
class Map_Directory_AddressesModel extends Kwf_Model_FnF
{
    public function __construct(array $config = array())
    {
        $config['uniqueIdentifier'] = 'id';
        $config['columns'] = array('id', 'name', 'talk_time', 'ministryschool_time',
            'coordinator', 'talk_organiser', 'circle_id', 'street', 'zip', 'country',
            'longitude', 'latitude', 'note', 'congregationIds'
        );
        $select = new Kwf_Model_Select();
        $select->where(new Kwf_Model_Select_Expr_NotEquals('street', ''));
        $select->where(new Kwf_Model_Select_Expr_NotEquals('zip', ''));
        $select->where(new Kwf_Model_Select_Expr_NotEquals('city', ''));
//         $select->where(new Kwf_Model_Select_Expr_NotEquals('country', ''));
        $rows = Kwf_Model_Abstract::getInstance('Congregations')->export(
            Kwf_Model_Abstract::FORMAT_ARRAY,
            $select
        );
        $uniqueRows = array();
        foreach ($rows as $row) {
            if (!isset($uniqueRows[$row['latitude'].$row['longitude']])) {
                $row['congregationIds'] = '';
                $uniqueRows[$row['latitude'].$row['longitude']] = $row;
            }
            $uniqueRows[$row['latitude'].$row['longitude']]['congregationIds'] .= $row['id'].';';
        }
        $config['data'] = array_values($uniqueRows);
        parent::__construct($config);
    }
}
