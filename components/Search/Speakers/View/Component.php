<?php
class Search_Speakers_View_Component extends Kwc_Directories_List_ViewAjax_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['searchForm'] = 'Search_Speakers_View_SearchForm_Component';
        $ret['plugins'] = array('Login_Plugin_Component');
        $ret['assets']['dep'][] = 'KwfSwitchDisplay';
        return $ret;
    }

    protected function _getSearchSelect($ret, $searchRow)
    {
        if ($searchRow->talk_number) {
            $select = new Kwf_Model_Select();
            $select->where(new Kwf_Model_Select_Expr_Or(array(
                new Kwf_Model_Select_Expr_Equals('number', $searchRow->talk_number),
                new Kwf_Model_Select_Expr_SearchLike(array(
                    'title' => $searchRow->talk_number
                ))
            )));
            $ret->where(new Kwf_Model_Select_Expr_Child_Contains('SpeakerToTalks', $select));
        }
        if ($searchRow->firstname) {
            $ret->where(new Kwf_Model_Select_Expr_SearchLike(array(
                'firstname' => $searchRow->firstname
            )));
        }
        if ($searchRow->lastname) {
            $ret->where(new Kwf_Model_Select_Expr_SearchLike(array(
                'lastname' => $searchRow->lastname
            )));
        }
        if ($searchRow->congregation) {
            $ret->whereEquals('congregation_id', $searchRow->congregation);
        }
        if ($searchRow->distance) {
            $user = Kwf_Registry::get('userModel')->getAuthedUser();
            $latitude = $user->getParentRow('Congregation')->latitude;
            $longitude = $user->getParentRow('Congregation')->longitude;
            $ret->where(new Kwf_Model_Select_Expr_Area($latitude, $longitude, $searchRow->distance));
        }
        $ret->whereEquals('deleted', 0);
        return $ret;
    }
}
