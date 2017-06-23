<?php


namespace TestApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NdbApiController
 *
 * @package TestApiBundle\Controller
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 *
 * @Route("/nbd_api_")
 */
class NdbApiController extends \NdbApiBundle\Controller\NdbApiController
{
    /**
     * @Route("/search", name="getFoodByName")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getFoodReportByNameAction(Request $request)
    {
        $response = parent::getFoodReportByNameAction($request);
        return $response;
    }
}
