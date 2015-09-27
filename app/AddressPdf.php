<?php
class AddressPdf extends Kwf_Pdf_TcPdf implements Kwf_Media_Output_Interface
{
    public static function getMediaOutput($id, $type, $className)
    {
        return AddressPdf::generateMediaOutput($id, $type, $className);
    }

    public static function generateMediaOutput($id, $type, $className) {
        $authedUser = Kwf_Model_Abstract::getInstance('Users')->getAuthedUser();
        if (!$authedUser) {
            throw new Kwf_Exception_AccessDenied();
        }
        if ($type == 'de') {
            $subroot = Kwf_Component_Data_Root::getInstance()->getChildComponent('-master');
        } else {
            $subroot = Kwf_Component_Data_Root::getInstance()->getChildComponent('-'.$type);
        }
        $addressPdf = new AddressPdf('', $id, $subroot);
        return array (
            'contents' => $addressPdf->Output('', 'S'),
            'mimeType' => 'application/pdf',
            'lifetime' => false,
            'downloadFilename' => $subroot->trl('Adressen.pdf')
        );
    }

    function __construct($type, $id, $subroot)
    {
        parent::__construct();
        $this->subroot = $subroot;
        $this->generatePdf();
    }

    private $_defaultFontFamily = 'freeserif';
    private $_defaultFontFontfile = '';
    public function generatePdf()
    {
        $marginTop = 10;
        $marginLeft = 30;
        $marginRight = 30;
        $pageFormat = 'A4';

        $this->SetTextColor(0, 0, 0);
        $this->SetAuthor('vtinfos.com');
        $this->SetTitle($this->subroot->trl('Versammlungen-Adressen'));

        $this->SetMargins($marginLeft, $marginTop, $marginRight);

        $this->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        $select = new Kwf_Model_Select();
        $select->order('name');
        $circleGroupRows = Kwf_Model_Abstract::getInstance('CircleGroups')->getRows($select);
        $this->AddPage('P', array(595.276, 841.890));
        foreach ($circleGroupRows as $circleGroupRow) {
            foreach ($circleGroupRow->getChildRows('Circles', $select) as $circleRow) {
                $defaultFontStyle = 'B';
                $defaultFontSize = 45;
                $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
                $this->MultiCell(0, 5, $this->subroot->trl('Kreis').' '.$circleRow->name, 0, 'L', false, 1, '', '', true);

                $defaultFontStyle = 'B';
                $defaultFontSize = 35;
                $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
                $this->MultiCell(150, 5, $this->subroot->trl('Versammlung'), 0, 'L', false, 0, '', '', true);
                $this->MultiCell(300, 5, $this->subroot->trl('Adresse'), 0, 'L', false, 0, '', '', true);
                $this->MultiCell(0, 5, $this->subroot->trl('Zeit'), 0, 'L', false, 1, '', '', true);
                $this->ln(5);
                foreach ($circleRow->getChildRows('Congregations', $select) as $congregationRow) {
                    $this->_writeCongregation($congregationRow);
                }
                $this->ln(15);
            }
            $this->AddPage('P', array(595.276, 841.890));
        }
        return $this;
    }

    private function _writeCongregation($congregationRow)
    {
        $defaultFontStyle = '';
        $defaultFontSize = 35;
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $this->MultiCell(150, 5, $congregationRow->name, 0, 'L', false, 0, '', '', true);
        $this->MultiCell(300, 5, $congregationRow->street.', '.$congregationRow->zip.' '.$congregationRow->city, 0, 'L', false, 0, '', '', true);
        $this->MultiCell(0, 5, $congregationRow->talk_time, 0, 'L', false, 1, '', '', true);
        $this->ln(10);
    }
}
