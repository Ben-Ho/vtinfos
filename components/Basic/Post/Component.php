<?php
class Basic_Post_Component extends Kwc_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trl('Post');
        $ret['assets']['files'][] = 'web/components/Basic/Post/Component.js';
        return $ret;
    }

    protected function _beforeInsert(Kwf_Model_Row_Interface $row)
    {
        parent::_beforeInsert($row);
    }
}
