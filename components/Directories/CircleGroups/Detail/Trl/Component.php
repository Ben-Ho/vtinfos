<?php
class Directories_CircleGroups_Detail_Trl_Component extends Kwc_Directories_Item_Detail_Trl_Component
{
    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['pdfDownloadUrl'] = Kwf_Media::getUrl(
            'CongregationsPdf',
            $this->getData()->getRow()->id,
            'circleGroup;'.$this->getData()->getLanguage(),
            $this->getData()->trl('Versammlungs.pdf')
        );
        return $ret;
    }
}
