<?php
class Forms_Speakers_ContentSender extends Kwf_Component_Abstract_ContentSender_Default
{
    protected function _getProcessInputComponents($includeMaster)
    {
        $showInvisible = Kwf_Component_Data_Root::getShowInvisible();
        Kwf_Component_Data_Root::setShowInvisible(true);
        $ret = parent::_getProcessInputComponents($this->_data);
        Kwf_Component_Data_Root::setShowInvisible($showInvisible);
        return $ret;
    }
}
