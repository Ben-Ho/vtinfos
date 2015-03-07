<?php
class Directories_CircleGroups_Detail_Component extends Kwc_Directories_Item_Detail_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['circles']
            = 'Directories_Circles_Directory_Component';
        $ret['plugins'] = array('Login_Plugin_Component');
        return $ret;
    }

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
