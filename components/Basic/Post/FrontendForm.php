<?php
class Basic_Post_FrontendForm extends Kwf_Form
{
    protected $_model = 'TranslateKeys';

    protected function _initFields()
    {
        parent::_initFields();
        $this->add(new Kwf_Form_Field_TextField('key', trl('Key')));
        $this->add(new Kwf_Form_Field_TextArea('comment', trl('Comment')));
    }
}
