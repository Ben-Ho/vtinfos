<?php
class Map_ViewMap_Component extends Kwc_Directories_List_ViewMap_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['plugins'] = array('Login_Plugin_Component');
        $ret['mapOptions']['zoom'] = 7;
        $ret['mapOptions']['zoom_properties'] = 1;
        $ret['mapOptions']['height'] = 400;
        $ret['mapOptions']['width'] = '';
        $ret['mapOptions']['scale'] = 1;
        $ret['mapOptions']['satelite'] = 1;
        $ret['mapOptions']['overview'] = 1;
        return $ret;
    }

    static public function getInfoWindowHtml($data)
    {
        return $data->render();
    }
}
