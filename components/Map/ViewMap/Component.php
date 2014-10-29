<?php
class Map_ViewMap_Component extends Kwc_Directories_List_ViewMap_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['mapOptions'] = array(
            'zoom' => 7,
            'zoom_properties' => 1,
            'height' => 400,
            'width' => '',
            'scale' => 1,
            'satelite' => 1,
            'overview' => 1,
//             'minimumResolution' => 7, // min zoomstufe wenn nötig
//             'maximumResolution' => 12, // max zoomstufe wenn nötig
            //'latitude' => 123, //optional, if not set center of shown cooridnates is used
            //'longitude' => 123, //optional, if not set center of shown cooridnates is used
        );
        return $ret;
    }

    static public function getInfoWindowHtml($data)
    {
        return $data->render();
    }
}
