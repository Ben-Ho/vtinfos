<?php
use KwfBundle\Serializer\KwfModel\ColumnNormalizer\ColumnNormalizerInterface;

class ColumnNormalizer_Speakers_RenameColumn implements ColumnNormalizerInterface
{
    public function normalize(Kwf_Model_Row_Interface $row, $column, array $settings, $format = null, array $context = array())
    {
        return $row->{$settings['column']};
    }
}
