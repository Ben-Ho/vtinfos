<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CongregationsController extends Controller
{
    private function handler()
    {
        return $this->get('app.handler.congregations');
    }

    public function getAction(Request $request)
    {
        $select = new \Kwf_Model_Select();
        if ($name = $request->get('name')) {
            $select->where(new \Kwf_Model_Select_Expr_SearchLike(array('name' => $name)));
        }
        if ($circleGroupId = $request->get('circle_group_id')) {
            $select->whereEquals('group_id', $circleGroupId);
        }
        if ($circleId = $request->get('circle_id')) {
            $select->whereEquals('circle_id', $circleId);
        }
        $select->order('name', 'ASC');

        return $this->handler()->createView(array(
            'data'=> $this->handler()->getRowsGranted($select, 'read'),
            'total' => $this->handler()->countRows($select)
        ));
    }
}
