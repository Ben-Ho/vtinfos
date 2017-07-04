<?php
class TalksToCategories extends Kwf_Model_Db
{
    protected $_table = 't_talks_to_categories';

    protected $_referenceMap = array(
        'Talk' => array(
            'refModelClass' => 'Talks',
            'column' => 'talk_id'
        ),
        'Category' => array(
            'refModelClass' => 'TalkCategories',
            'column' => 'category_id'
        )
    );
}
