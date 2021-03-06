<?php
class Directories_Congregations_Detail_LastChange_Component extends Kwc_Abstract_Composite_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['viewCache'] = false;
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['lastChange'] = $this->getData()->parent->row->congregation_last_change;
        return $ret;
    }
}
