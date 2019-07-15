<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CircleGroupsController extends Controller
{
    private function handler()
    {
        return $this->get('app.handler.circleGroups');
    }

    public function getAction(Request $request) // query + queryColumns
    {
        $select = $this->handler()->buildSelect($request, array('queryColumns' => array('name')));
        $select->order('name', 'ASC');

        return $this->handler()->createView(array(
            'data'=> $this->handler()->getRowsGranted($select, 'read'),
            'total' => $this->handler()->countRows($select)
        ));
    }
}
