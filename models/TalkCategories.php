<?php
class TalkCategories extends Kwf_Model_Db
{
    protected $_table = 't_talk_categories';
    protected $_dependentModels = array(
        'TalksToCategories' => 'TalksToCategories', //The second value is the modelname
        'TalkCategoryTitles' => 'TalkCategoryTitles'
    );
}
