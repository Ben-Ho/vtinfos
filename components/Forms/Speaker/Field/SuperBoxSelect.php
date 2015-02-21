<?php
class Forms_Speaker_Field_SuperBoxSelect extends Kwf_Form_Field_Abstract
{
    protected $_fields;
    private $_relationToValuesRule;
    private $_dataModel;
    private $_relModel;
    private $_valuesModel;
    private $_valuesSelect;

    public function __construct($dependetModelRule, $relationToValuesRule, $title = null, $fieldKey = null)
    {
        if (!is_string($dependetModelRule)) {
            if (is_object($dependetModelRule) && !($dependetModelRule instanceof Kwf_Model_Abstract)) {
                throw new Kwf_Exception("dependetModelRule must be of type string (Rule) or Kwf_Model_Abstract (RelationModel)");
            }
        }
        $this->_relModel = $dependetModelRule;
        $this->setValuesModel($relationToValuesRule);
        $this->_relationToValuesRule = $relationToValuesRule;

        if (!$fieldKey) $fieldKey = $relationToValuesRule;

        parent::__construct($fieldKey);
        if ($title) {
            $this->setTitle($title);
            $this->setFieldLabel($title);
        }
        $this->setAutoHeight(true);
        $this->setLayout('form');
    }

    public function setValuesSelect(Kwf_Model_Select $select)
    {
        $this->_valuesSelect = $select;
        return $this;
    }

    public function setDataModel($dataModel)
    {
        $this->_dataModel = $dataModel;
        return $this;
    }

    public function getDataModel()
    {
        if (is_string($this->_dataModel)) {
            $this->_dataModel = Kwf_Model_Abstract::getInstance($this->_dataModel);
        }
        return $this->_dataModel;
    }

    public function getRelModel()
    {
        if (is_string($this->_relModel)) {
            $m = $this->getDataModel();
            $this->_relModel = $m->getDependentModel($this->_relModel);
        }
        return $this->_relModel;
    }

    public function load(Kwf_Model_Row_Interface $row, $postData = array())
    {
        if (!$row) return array();

        $dataModel = $row->getModel();
        if ($dataModel) $this->setDataModel($dataModel);

        $ref = $this->getRelModel()->getReference($this->_relationToValuesRule);
        $key = $ref['column'];

        $selectedIds = array();
        if ($this->getSave() !== false && $row) {
            foreach ($row->getChildRows($this->getRelModel()) as $i) {
                $selectedIds[] = $i->number;
            }
        }
        return array($this->getFieldName() => $selectedIds);
    }

    public function validate($row, $postData)
    {
        $ret = parent::validate($row, $postData);
        return $ret;
    }

    public function prepareSave(Kwf_Model_Row_Interface $row, $postData)
    {
        $dataModel = $row->getModel();
        if ($dataModel) $this->setDataModel($dataModel);


        $selection = json_decode($postData[$this->getFieldName()]);
        $selectionIds = array();
        foreach ($selection as $value) {
            $select = new Kwf_Model_Select();
            $select->whereEquals('number', $value);
            $talkRow = Kwf_Model_Abstract::getInstance('Talks')->getRow($select);
            if ($talkRow)
                $selectionIds[] = $talkRow->id;
        }

        foreach ($row->getChildRows($this->getRelModel()) as $savedRow) {
            if (!in_array($savedRow->talk_id, $selectionIds)) {
                $savedRow->delete();
            } else {
                unset($selectionIds[array_search($savedRow->talk_id, $selectionIds)]);
            }
        }
        foreach ($selectionIds as $id) {
            $newRow = $row->createChildRow('SpeakerToTalks');
            $newRow->talk_id = $id;
        }
    }

    public function getTemplateVars($values, $fieldNamePostfix = '', $idPrefix = '')
    {
        $ret = parent::getTemplateVars($values, $fieldNamePostfix, $idPrefix);
        $values = $values[$this->getFieldName()];
        $ret['html']  = '<div class="inputRegion">'."\n";
        $ret['html'] .= '    <input class="selection" type="hidden" value="'.htmlspecialchars(json_encode($values)).'"';
        $ret['html'] .=        ' name="'.$this->getFieldName().$fieldNamePostfix.'" />'."\n";
        $ret['html'] .= '    <div class="selectedValues"></div>'."\n";
        $ret['html'] .= '    <div class="addValue">'."\n";
        $ret['html'] .= '        <input type="text" class="newValue"/>'."\n";
        $ret['html'] .= '        <span class="button">+</span>'."\n";
        $ret['html'] .= '    </div>'."\n";
        $ret['html'] .= '</div>';
        return $ret;
    }
}
