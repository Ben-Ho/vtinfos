<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SpeakersController extends Controller
{
    private function handler()
    {
        return $this->get('app.handler.speakers');
    }

    public function searchAction(Request $request)
    {
        $language = $request->get('language');
        $limitMax = 20;
        $limitDefault = 10;
        $startDefault = 0;

        $select = new \Kwf_Model_Select();

        $talkSelect = new \Kwf_Model_Select();
        if ($request->get('talkLanguage')) {
            $talkSelect->whereEquals('language', $request->get('talkLanguage'));
        }
        if ($request->get('talk')) {
            if (is_numeric($request->get('talk'))) {
                $talkSelect->whereEquals('number', $request->get('talk'));
            } else {
                $talkSelect->where(new \Kwf_Model_Select_Expr_SearchLike(array(
                    'title' => $request->get('talk')
                )));
            }
        }
        $select->where(new \Kwf_Model_Select_Expr_Child_Contains('SpeakerToTalks', $talkSelect));

        if ($request->get('firstname')) {
            $select->where(new \Kwf_Model_Select_Expr_SearchLike(array('firstname' => $request->get('firstname'))));
        }
        if ($request->get('lastname')) {
            $select->where(new \Kwf_Model_Select_Expr_SearchLike(array('lastname' => $request->get('lastname'))));
        }
        if ($request->get('phone')) {
            $phone = str_replace(' ', '', $request->get('phone'));
            $select->where(new \Kwf_Model_Select_Expr_SearchLike(array(
                'phone_normalized' => $phone,
                'phone2_normalized' => $phone
            )));
        }

        if ($request->get('congregation')) {
            $select->whereEquals('congregation_id', $request->get('congregation'));
        } else if ($request->get('circle')) {
            if (strpos($request->get('circle'), 'g') === 0) {
                $select->whereEquals('group_id', str_replace('g_', '', $request->get('circle')));
            } else if (strpos($request->get('circle'), 'c') === 0) {
                $select->whereEquals('circle_id', str_replace('c_', '', $request->get('circle')));
            }
        }

        $distance = trim($request->get('maxDistance'));
        if ($distance && is_numeric($distance)) {
            $user = \Kwf_Registry::get('userModel')->getAuthedUser();
            $latitude = $user->getParentRow('Congregation')->latitude;
            $longitude = $user->getParentRow('Congregation')->longitude;
            $select->where(new \Kwf_Model_Select_Expr_Area($latitude, $longitude, $request->get('maxDistance')));
        }
        if ($request->get('noBeard')) {
            $select->whereEquals('has_beard', 0);
        }
        $select->whereEquals('deleted', 0);
        $select->whereEquals('inactive', 0);

        $order = $request->get('order', 'lastname');
        if (in_array($order, array('lastname', 'firstname'))) {
            $select->order($order);
        }

        $select->limit(min($request->get('limit', $limitDefault), $limitMax), $request->get('start', $startDefault));

        $view = $this->handler()->createView(array(
            'data'=> $this->handler()->getRowsGranted($select, 'read'),
            'total' => $this->handler()->countRows($select)
        ));
        $view->getContext()->setAttribute('language', $language);
        if ($talkLanguage = $request->get('talkLanguage')) {
            $view->getContext()->setAttribute('talkLanguage', $talkLanguage);
        }
        return $view;
    }
}
