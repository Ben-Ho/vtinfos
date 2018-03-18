<?php
use KwfBundle\Serializer\KwfModel\ColumnNormalizer\ColumnNormalizerInterface;
use KwfBundle\Serializer\KwfModel\ColumnNormalizer\CacheableInterface;

class ColumnNormalizer_Speakers_CongregationUrl implements ColumnNormalizerInterface//, CacheableInterface
{
    public function normalize(Kwf_Model_Row_Interface $row, $column, array $settings, $format = null, array $context = array())
    {
        $language = $context['language'] == 'de' ? 'master' : $context['language'];
        $subroot = Kwf_Component_Data_Root::getInstance()->getComponentById('root-'.$language);

        $congregationDir = Kwf_Component_Data_Root::getInstance()->getComponentByClass('Directories_Congregations_Directory_Component', array('subroot'=>$subroot));
        d($congregationDir);
        d($subroot->getComponentsBy);
        d(\Kwf_Component_Data_Root::getInstance()->getComponentByDbId('congregations_'.$row->congregation_id, array('subroot'=>$subroot)));
        return \Kwf_Component_Data_Root::getInstance()->getComponentByDbId('congregations_'.$row->congregation_id, array('subroot'=>$subroot))->getUrl();
    }
//
//    public function getEventSubscribers(Kwf_Model_Interface $model, $column, array $settings)
//    {
//        return array(
//            Kwf_Model_EventSubscriber::getInstance('ColumnNormalizer_Speakers_CongregationUrl', array(
//                //'modelFactoryConfig' => $model->getFactoryConfig(),
//                'column' => $column
//            ))
//        );
//    }
//    public function getCacheId(Kwf_Model_Row_Interface $row, $column, array $settings, $format = null, array $context = array())
//    {
//        return 'norm__'.$row->getModel()->getUniqueIdentifier().'__'.$column.'__'.$row->id.'__'.$context['language'];
//    }
//    public function getConfig()
//    {
//        return array();
//    }
}
