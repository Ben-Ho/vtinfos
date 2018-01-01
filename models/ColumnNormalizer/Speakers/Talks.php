<?php
use KwfBundle\Serializer\KwfModel\ColumnNormalizer\ColumnNormalizerInterface;

class ColumnNormalizer_Speakers_Talks implements ColumnNormalizerInterface
{
    public function normalize(Kwf_Model_Row_Interface $row, $column, array $settings, $format = null, array $context = array())
    {
        $language = $context['language'] == 'de' ? 'master' : $context['language'];
        $subroot = Kwf_Component_Data_Root::getInstance()->getComponentById('root-'.$language);

        $select = new Kwf_Model_Select();
        $select->order('number', 'ASC');

        $talks = array();
        foreach ($row->getChildRows('SpeakerToTalks', $select) as $talkRelationRow) {
            $title = $talkRelationRow->getParentRow('Talk')->getTitle($talkRelationRow->language).' ('.Talks::getLanguage($talkRelationRow->language, $subroot).')';
            $talks[] = array('id' => $talkRelationRow->id, 'number' => $talkRelationRow->number, 'title' => $title);
        }
        return $talks;
    }
}
