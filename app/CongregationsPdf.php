<?php
class CongregationsPdf extends Kwf_Pdf_TcPdf implements Kwf_Media_Output_Interface
{
    public static function getMediaOutput($id, $type, $className)
    {
        return CongregationsPdf::generateMediaOutput($id, $type, $className);
    }

    public static function generateMediaOutput($id, $type, $className) {
        $authedUser = Kwf_Model_Abstract::getInstance('Users')->getAuthedUser();
        if (!$authedUser) {
            throw new Kwf_Exception_AccessDenied();
        }
        $splited = explode(';', $type);
        if ($splited[1] == 'de') {
            $subroot = Kwf_Component_Data_Root::getInstance()->getChildComponent('-master');
        } else {
            $subroot = Kwf_Component_Data_Root::getInstance()->getChildComponent('-'.$splited[1]);
        }
        $congregationPdf = new CongregationsPdf($splited[0], $id, $subroot);
        return array (
            'contents' => $congregationPdf->Output('', 'S'),
            'mimeType' => 'application/pdf',
            'lifetime' => false,
            'downloadFilename' => $subroot->trl('Versammlungen.pdf')
        );
    }

    private function _generateArrayCircle($circleRow) {
        return array(
            'row' => $circleRow,
            'congregations' => $circleRow->getChildRows('Congregations')
        );
    }

    private function _generateArrayCircleGroup($circleGroupRow) {
        $data = array();
        $data['row'] = $circleGroupRow;
        $data['circles'] = array();
        foreach ($circleGroupRow->getChildRows('Circles') as $circleRow) {
            $data['circles'][] = $this->_generateArrayCircle($circleRow);
        }
        return $data;
    }

    function __construct($type, $id, $subroot)
    {
        parent::__construct();
        if ($type == 'all') {
            $data = array();
            foreach (Kwf_Model_Abstract::getInstance('CircleGroups')->getRows() as $circleGroupRow) {
                $data[] = $this->_generateArrayCircleGroup($circleGroupRow);
            }

        } else if ($type == 'circleGroup') {
            $circleGroupRow = Kwf_Model_Abstract::getInstance('CircleGroups')->getRow($id);
            $data = array(
                $this->_generateArrayCircleGroup($circleGroupRow)
            );

        } else if ($type == 'circle') {
            $circleRow = Kwf_Model_Abstract::getInstance('Circles')->getRow($id);
            $circleGroupRow = $circleRow->getParentRow('Group');
            $data = array(
                array(
                    'row' => $circleGroupRow,
                    'circles' => array(
                        $this->_generateArrayCircle($circleRow)
                    )
                )
            );

        } else if ($type == 'congregation') {
            $congregationRow = Kwf_Model_Abstract::getInstance('Congregations')->getRow($id);
            $circleRow = $congregationRow->getParentRow('Circle');
            $circleGroupRow = $circleRow->getParentRow('Group');

            $data = array(
                array(
                    'row' => $circleGroupRow,
                    'circles' => array(
                        array(
                            'row' => $circleRow,
                            'congregations' => array(
                                $congregationRow
                            )
                        )
                    )
                )
            );
        } else {
            throw new Kwf_Exception("Type $type not supported");
        }

        $this->subroot = $subroot;
        $this->_circleGroups = $data;
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
        $this->SetTitle($this->subroot->trl('Versammlungen-Übersicht'));

        $this->SetMargins($marginLeft, $marginTop, $marginRight);

        $this->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        foreach ($this->_circleGroups as $circleGroup) {
            $this->AddPage('P', array(595.276, 841.890));
            $this->_writeCircleGroupTitle($circleGroup['row']);
            foreach ($circleGroup['circles'] as $circle) {
                $this->_writeCircleTitle($circle['row']);
                $firstCongregation = true;
                foreach ($circle['congregations'] as $congregationRow) {
                    if (!$firstCongregation) {
                        $this->AddPage('P', array(595.276, 841.890));
                    } else {
                        $firstCongregation = false;
                    }
                    $this->_writeCongregation($congregationRow);
                }
            }
        }

        return $this;
    }

    private function _writeCircleGroupTitle($circleGroupRow)
    {
        $defaultFontStyle = 'B';
        $defaultFontSize = 80;
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $this->Write(20, $circleGroupRow->name, '', false, 'C', true, 0, false, false, 0, '', '');
    }

    private function _writeCircleTitle($circleRow)
    {
        $defaultFontSize = 60;
        $defaultFontStyle = 'B';
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $this->Write(20, $circleRow->name, '', false, 'L', true, 0, false, false, 0, '', '');
    }

    private function _writeCongregation($congregationRow)
    {
        // Versammlungsname
        $defaultFontSize = 50;
        $defaultFontStyle = 'B';
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $this->Write(20, $congregationRow->name, '', false, 'L', true, 0, false, false, 0, '', '');

        // Kreis
        $defaultFontSize = 30;
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $this->Write(20, $this->subroot->trl('Kreis').': '.$congregationRow->getParentRow('Circle')->name, '', false, 'L', true, 0, false, false, 0, '', '');

        // Adresse
        $country = '';
        if ($congregationRow->country) {
            $country = Kwf_Model_Abstract::getInstance('Kwf_Util_Model_Countries')
                ->getNameByLanguageAndId($this->subroot->getLanguage(), $congregationRow->country);
        }
        $address = $congregationRow->street.', '.$congregationRow->zip.' '.$congregationRow->city.' - '.$country;
        $defaultFontStyle = '';
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $this->Write(20, $address, '', false, 'L', true, 0, false, false, 0, '', '');

        // Versammlungszeiten
        $this->Write(10, $this->subroot->trl('Dienstzusammenkunft').': ', '', false, 'L', false, 0, false, false, 0, '', '');
        $this->Write(10, $congregationRow->ministryschool_time, '', false, 'L', true, 0, false, false, 0, '', '');
        $this->Write(10, $this->subroot->trl('Öffentl. Vortrag').': ', '', false, 'L', false, 0, false, false, 0, '', '');
        $this->Write(10, $congregationRow->talk_time, '', false, 'L', true, 0, false, false, 0, '', '');

        // KO & VE
        $this->ln(10);
        $defaultFontStyle = 'B';
        $defaultFontSize = 40;
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $width = 260;
        $this->MultiCell($width, 5, $this->subroot->trl('Koordinator'), 0, 'L', 0, 0, '', '', true);
        $this->MultiCell($width, 5, $this->subroot->trl('Vortragseinteiler'), 0, 'L', 0, 1, '', '', true);

        $defaultFontStyle = '';
        $defaultFontSize = 30;
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $coordinator = $this->_generateSpeakerDetail($congregationRow->getParentRow('Coordinator'));
        $this->MultiCell($width, 5, $coordinator, 0, 'L', 0, 0, '', '', true);
        $talkOrganiser = $this->_generateSpeakerDetail($congregationRow->getParentRow('TalkOrganiser'));
        $this->MultiCell($width, 5, $talkOrganiser, 0, 'L', 0, 1, '', '', true);

        // Notiz
        if ($congregationRow->note) {
            $defaultFontStyle = 'I';
            $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
            $this->Write(20, $congregationRow->note, '', false, 'L', true, 0, false, false, 0, '', '');
        }

        $select = new Kwf_Model_Select();
        $select->where(new Kwf_Model_Select_Expr_Not(
            new Kwf_Model_Select_Expr_Or(array(
                new Kwf_Model_Select_Expr_Equals('deleted', 1),
                new Kwf_Model_Select_Expr_Equals('inactive', 1)
            ))
        ));
        foreach ($congregationRow->getChildRows('Speakers', $select) as $speakerRow) {
            $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
            $this->Write(20, '', '', false, 'L', true, 0, false, false, 0, '', '');
            $this->_writeSpeaker($speakerRow);
        }
    }

    private function _generateSpeakerDetail($speakerRow)
    {
        if (!$speakerRow) return $this->subroot->trl('keine Auswahl');
        $speakerDetail  = "$speakerRow->name\n";
        $phone = $speakerRow->phone;
        if ($speakerRow->phone2) {
            $phone .= ', '.$speakerRow->phone2;
        }
        $speakerDetail .= "$phone\n";
        $speakerDetail .= $speakerRow->email;
        return $speakerDetail;
    }

    private function _writeSpeaker($speakerRow)
    {
        // Name
        $defaultFontSize = 40;
        $defaultFontStyle = 'B';
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $this->Write(20, $speakerRow->name, '', false, 'L', false, 0, false, false, 0, '', '');

        $degree = '?';
        if ($speakerRow->degree == 'e') {
            $degree = $this->subroot->trl('Ä');
        } else if ($speakerRow->degree == 'm') {
            $degree = $this->subroot->trl('DAG');
        }
        $defaultFontSize = 30;
        $defaultFontStyle = '';
        $this->SetTextColor(100, 100, 100);
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        $this->Write(20, '('.$degree.')', '', false, 'L', false, 0, false, false, 0, '', '');
        $this->Write(20, ' ', '', false, 'L', false, 0, false, false, 0, '', '');

        $this->SetTextColor(0, 0, 0);
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);

        $phone = $speakerRow->phone;
        if ($speakerRow->phone2) {
            $phone .= ', '.$speakerRow->phone2;
        }
        $this->Write(20, $this->subroot->trl('Tel.Nr.').': '.$phone, '', false, 'L', true, 0, false, false, 0, '', '');

        if ($speakerRow->note) {
            $this->Write(20, $this->subroot->trl('Anmerkung').': '.$speakerRow->note, '', false, 'L', true, 0, false, false, 0, '', '');
        }

        if ($speakerRow->has_beard) {
            $defaultFontStyle = 'B';
            $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
            $this->Write(20, $this->subroot->trl('Hat Voll-/Modebart'), '', false, 'L', true, 0, false, false, 0, '', '');
        }

        $defaultFontStyle = '';
        $this->SetFont($this->_defaultFontFamily, $defaultFontStyle, $defaultFontSize, $this->_defaultFontFontfile);
        foreach ($speakerRow->getChildRows('SpeakerToTalks') as $talkRelationRow) {
            $title = $talkRelationRow->getParentRow('Talk')->getTitle($this->subroot->getLanguage());
            $this->Write(5, str_pad($talkRelationRow->number, 3, '0', STR_PAD_LEFT).' '.$title, '', false, 'L', true, 0, false, false, 0, '', '');
        }
    }
}
