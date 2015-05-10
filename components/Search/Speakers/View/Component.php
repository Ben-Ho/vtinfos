<?php
class Search_Speakers_View_Component extends Kwc_Directories_List_ViewAjax_Component
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['child']['component']['searchForm'] = 'Search_Speakers_View_SearchForm_Component';
        $ret['plugins'] = array('Login_Plugin_Component');
        $ret['assets']['dep'][] = 'KwfSwitchDisplay';
        $ret['placeholder']['noEntriesFound'] = '';
        return $ret;
    }

    protected function _getSearchSelect($ret, $searchRow)
    {
        $ret = new Kwf_Component_Select();
        $ret->whereGenerator('detail');
        if ($searchRow->talk_number) {
            $select = new Kwf_Model_Select();
            $orExprs = array(
                new Kwf_Model_Select_Expr_Equals('number', $searchRow->talk_number),
                new Kwf_Model_Select_Expr_SearchLike(array(
                    'title' => $searchRow->talk_number
                ))
            );
            if ($searchRow->talk_language) {
                $orExprs[] = new Kwf_Model_Select_Expr_Equals('language', $searchRow->talk_language);
            }
            $select->where(new Kwf_Model_Select_Expr_Or($orExprs));
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
        if ($searchRow->circle) {
            if (strpos($searchRow->circle, 'g') === 0) {
                $ret->whereEquals('group_id', str_replace('g_', '', $searchRow->circle));
            } else if (strpos($searchRow->circle, 'c') === 0) {
                $ret->whereEquals('circle_id', str_replace('c_', '', $searchRow->circle));
            }
        }
        if ($searchRow->distance) {
            $user = Kwf_Registry::get('userModel')->getAuthedUser();
            $latitude = $user->getParentRow('Congregation')->latitude;
            $longitude = $user->getParentRow('Congregation')->longitude;
            $ret->where(new Kwf_Model_Select_Expr_Area($latitude, $longitude, $searchRow->distance));
        }
        if ($searchRow->no_beard) {
            $ret->whereEquals('has_beard', 0);
        }
        $ret->whereEquals('deleted', 0);
        $ret->whereEquals('inactive', 0);
        $ret->order('lastname');
        return $ret;
    }
}
