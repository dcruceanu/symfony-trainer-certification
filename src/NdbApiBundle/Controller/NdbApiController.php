<?php

namespace NdbApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class NdbApiController extends Controller
{
    /**
     *
     * @Route("/search", name="getFoodByName")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getFoodReportByNameAction(Request $request)
    {
        $foodManagerService = $this->container->get('food_manager_service');
        $foodDetails = $foodManagerService->searchFoodByName($request->get('name'));
        $foodObjectDetails = json_decode($foodDetails);
        $listOfNutrientsFor100GramsOfProduct = [];

        if(null !== $foodObjectDetails && null !== $foodObjectDetails->list
                && null !== $foodObjectDetails->list->item[0]
                    && null !== $foodObjectDetails->list->item[0]->ndbno) {
                        $idOfTheSearchedFood = $foodObjectDetails->list->item[0]->ndbno;
                        $foodReport = json_decode($foodManagerService->getFoodReportByFoodId($idOfTheSearchedFood));
                        $nutrients = $foodReport->report->food->nutrients;

            for($i = 0; $i < count($nutrients); $i++) {
                $listOfNutrientsFor100GramsOfProduct = $listOfNutrientsFor100GramsOfProduct + [
                        $nutrients[$i]->name => $nutrients[$i]->value . " ".$nutrients[$i]->unit
                    ];
            }
        }

        return new JsonResponse($listOfNutrientsFor100GramsOfProduct);
    }
}
