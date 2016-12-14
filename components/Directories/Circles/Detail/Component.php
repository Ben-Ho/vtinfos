<?php
class Directories_Circles_Detail_Component extends Kwc_Directories_Item_Detail_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['child']['component']['congregations']
            = 'Directories_Circles_Detail_Congregations_Component';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['pdfDownloadUrl'] = Kwf_Media::getUrl(
            'CongregationsPdf',
            $this->getData()->getRow()->id,
            'circle;'.$this->getData()->getLanguage(),
            $this->getData()->trl('Versammlungs.pdf')
        );
        return $ret;
    }
}
