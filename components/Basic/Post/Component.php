<?php
class Basic_Post_Component extends Kwc_Form_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trl('Post');
        $ret['assets']['files'][] = 'web/components/Basic/Post/Component.js';
        return $ret;
    }

    protected function _afterInsert(Kwf_Model_Row_Interface $row)
    {

        parent::_afterInsert($row);
        // This is our new stuff
        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
        $socket->connect("tcp://localhost:5555");

        $socket->send(json_encode($row->toArray()));
    }
}
