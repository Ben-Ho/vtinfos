<?php
class Forms_Speakers_Generator extends Kwf_Component_Generator_Table
{
    protected function _formatSelect($parentData, $select)
    {
        $select = parent::_formatSelect($parentData, $select);
        if (is_null($select)) return null;

        $user = Kwf_Registry::get('userModel')->getAuthedUser();
        if ($user) {
            $select->whereEquals('congregation_id', $user->congregation_id);
        }
        return $select;
    }
}
