<?php
class Cli_ReminderController extends Kwf_Controller_Action
{
    public function indexAction()
    {
        $select = new Kwf_Model_Select();
        $select->whereEquals('wants_reminder', true);
        $select->where(new Kwf_Model_Select_Expr_Or(array(
            new Kwf_Model_Select_Expr_IsNull('last_reminder'),
            new Kwf_Model_Select_Expr_LowerEqual('last_reminder', new Kwf_Date('-6 Months'))
        )));
        foreach (Kwf_Model_Abstract::getInstance('Users')->getRows($select) as $userRow) {
            if (!$userRow->last_reminder) {
                $userRow->last_reminder = date('Y-m-d');
                $userRow->save();
                continue;
            }
            $root = $userRow->language ? $userRow->language : 'de';
            if ($root == 'de') $root = 'master';
            $cmp = Kwf_Component_Data_Root::getInstance()->getChildComponent('-'.$root);
            if (!$cmp) $cmp = Kwf_Component_Data_Root::getInstance()->getChildComponent('-en');
            $mail = new Kwf_Mail_Template('Reminder');
            $mail->data = $cmp;
            $mail->addTo($userRow->email);
            $mail->setFrom('no-reply@vtinfos.com');
            $mail->setSubject($cmp->trl('vtinfos: Bitte Daten überprüfen'));
            $mail->send();
            $userRow->last_reminder = date('Y-m-d');
            $userRow->save();
        }
        exit;
    }
}
