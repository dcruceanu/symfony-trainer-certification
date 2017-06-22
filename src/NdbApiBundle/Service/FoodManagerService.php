<?php


namespace NdbApiBundle\Service;
use NdbApiBundle\Repository\FoodManagerRepository;

/**
 * Class FoodManagerService
 *
 * @package NdbApiBundle\Service
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 */
class FoodManagerService
{
    /**
     * @var FoodManagerRepository
     */
    protected $foodManagerRepository;

    /**
     * FoodManagerService constructor.
     *
     * @param $foodManagerRepository
     */
    public function __construct($foodManagerRepository)
    {
        $this->foodManagerRepository = $foodManagerRepository;
    }

    public function getFoodReportByFoodId($id)
    {
        return $this->foodManagerRepository->getFoodReportByFoodId($id);
    }

    public function searchFoodByName($name)
    {
        return $this->foodManagerRepository->searchFoodByName($name);
    }
}
