<?php
class Talks_CongregationsController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'Congregations';

    //TODO add form to add congregation with koordinator und ve auswahl
    protected function _initColumns()
    {
        parent::_initColumns();
        $select = new Kwf_Model_Select();
        $select->order('name');
        $circleRows = Kwf_Model_Abstract::getInstance('Circles')->getRows($select);
        $comboBox = new Kwf_Form_Field_ComboBox();
        $comboBox->setValues($circleRows);
        $this->_columns->add(new Kwf_Grid_Column('circle_id', trl('Kreis'), 100))
            ->setRenderer('name')
            ->setEditor($comboBox);
        $this->_columns->add(new Kwf_Grid_Column('org_g_uid', trl('GUID')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('last_sync', trl('Last-Sync')))
            ->setEditor(new Kwf_Form_Field_DateField());
        $this->_columns->add(new Kwf_Grid_Column('name', trl('Name')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('street', trl('Straße')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('zip', trl('PLZ')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('city', trl('Ort')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('country', trl('Land')))
            ->setRenderer('name')
            ->setEditor(new Kwf_Form_Field_SelectCountry());
        $this->_columns->add(new Kwf_Grid_Column('talk_time', trl('Vortrag Zeit/Tag')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('ministryschool_time', trl('Leben- und Dienstzusammenkunft')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('note', trl('Anmerkung')))
            ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('latitude', trl('Latitude')))
        ->setEditor(new Kwf_Form_Field_TextField());
        $this->_columns->add(new Kwf_Grid_Column('longitude', trl('Longitude')))
            ->setEditor(new Kwf_Form_Field_TextField());
    }

    protected function _getSelect()
    {
        $select = parent::_getSelect();
        $select->whereEquals('circle_id', $this->_getParam('circle_id'));
        return $select;
    }

    protected function _beforeInsert(Kwf_Model_Row_Interface $row, $submitRow)
    {
        parent::_beforeInsert($row, $submitRow);
        $row->circle_id = $this->_getParam('circle_id');
    }

    protected function _beforeSave(Kwf_Model_Row_Interface $row, $submitRow)
    {
        if (!$row->longitude && !$row->latitude && $row->zip) {
            $select = new Kwf_Model_Select();
            $select->whereEquals('zip', $row->zip);
            $zipRow = Kwf_Model_Abstract::getInstance('ZipToLocation')->getRow($select);
            if ($zipRow) {
                $row->longitude = $zipRow->longitude;
                $row->latitude = $zipRow->latitude;
            } else if ($row->zip && $row->country) {
                $coordinates = Kwf_Util_Geocode::getCoordinates($row->zip.' '.$row->country);
                $row->longitude = $coordinates['lng'];
                $row->latitude = $coordinates['lat'];
                $zipRow = Kwf_Model_Abstract::getInstance('ZipToLocation')->createRow();
                $zipRow->zip = $row->zip;
                $zipRow->longitude = $coordinates['lng'];
                $zipRow->latitude = $coordinates['lat'];
                $zipRow->save();
            }
        }
        parent::_beforeSave($row, $submitRow);
    }
}
