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
        $select = new Kwf_Model_Select();
        $select->whereEquals('role', 'admin');
        $select->order('received_inquires', 'ASC');
        $admins = Kwf_Registry::get('userModel')->getRows($select);
//         $row->addTo($admins[0]->email);
        $row->addTo('benjamin.hohenwarter@gmail.com');
        $row->setFrom($row->email);
        $row->subject = 'Anfrage auf vtinfos';
        parent::_beforeSave($row);
    }
}
