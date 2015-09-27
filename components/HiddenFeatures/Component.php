<?php
class HiddenFeatures_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['viewCache'] = false;
        $ret['componentName'] = trlStatic('Spezial-Features');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        if ($user->feature_address_pdf) {
            $ret['addressPdfUrl'] = Kwf_Media::getUrl(
            'AddressPdf',
            0,
            $this->getData()->getLanguage(),
            $this->getData()->trl('Adressen.pdf')
        );
        }
        return $ret;
    }
}
