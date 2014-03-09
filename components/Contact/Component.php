<?php
class Contact_Component extends Kwc_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trl('Kontakt-Formular');
        $ret['generators']['child']['component']['header'] = 'Contact_Header_Component';
        $ret['placeholder']['submitButton'] = trlStatic('Abschicken');
        return $ret;
    }

    protected function _beforeSave(Kwf_Model_Row_Interface $row)
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
        } else {
            $host = Kwf_Registry::get('config')->server->domain;
        }

        $row->addTo('benjamin.hohenwarter@gmail.com');
        $row->setFrom($row->email);
        $row->subject = trl('Anfrage auf {0}',$host);
        parent::_beforeSave($row);
    }
}
