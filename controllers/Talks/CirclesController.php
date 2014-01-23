<?php
class Talks_CirclesController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'Circles';

    public function indexAction()
    {
        parent::indexAction();
        $this->view->xtype = 'vtinfos.structure';
    }

    protected function _initColumns()
    {
        parent::_initColumns();
        $comboBox = new Kwf_Form_Field_Select();
        $data = Kwf_Model_Abstract::getInstance('CircleGroups')->getRows();
        $comboBox->setValues($data);
        $this->_columns->add(new Kwf_Grid_Column('group_id', trl('Group')))
            ->setEditor($comboBox);
//             ->setData(new Talks_CirclesControllerGroup());
        $this->_columns->add(new Kwf_Grid_Column('name', trl('Name')))
            ->setEditor(new Kwf_Form_Field_TextField());
    }

    protected function _getSelect()
    {
        $select = parent::_getSelect();
        $select->whereEquals('group_id', $this->_getParam('group_id'));
        return $select;
    }

    protected function _beforeInsert(Kwf_Model_Row_Interface $row, $submitRow)
    {
        parent::_beforeInsert($row, $submitRow);
        $row->group_id = $this->_getParam('group_id');
    }
}
class Talks_CirclesControllerGroup extends Kwf_Data_Abstract
{
    public function load($row)
    {
        return $row->group;
    }
}
