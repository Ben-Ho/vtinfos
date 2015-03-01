<?php
class Talks_TalksController extends Kwf_Controller_Action_Auto_Grid
{
    protected $_model = 'Talks';

    public function indexAction()
    {
        parent::indexAction();
        $this->view->xtype = 'vtinfos.talks';
    }

    protected function _initColumns()
    {
        parent::_initColumns();
        $this->_columns->add(new Kwf_Grid_Column('number', trl('Nummer')))
            ->setEditor(new Kwf_Form_Field_NumberField());
        $this->_columns->add(new Kwf_Grid_Column('title', trl('Titel'), 350))
            ->setEditor(new Kwf_Form_Field_TextField());
    }

    protected function _getSelect()
    {
        $select = parent::_getSelect();
        $select->order('number');
        return $select;
    }
}
