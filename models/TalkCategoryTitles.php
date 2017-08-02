<?php
class TalkCategoryTitles extends Kwf_Model_Db
{
    protected $_table = 't_talk_category_titles';
    protected $_toStringField = 'title';

    protected $_referenceMap = array(
        'TalkCategory' => array(
            'refModelClass' => 'TalkCategories',
            'column' => 'category_id'
        )
    );
}
