<?php


namespace TestApiBundle\Service;

/**
 * Class FoodManagerService
 *
 * @package TestApiBundle\Service
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 */
class FoodManagerService extends \NdbApiBundle\Service\FoodManagerService
{
    public function getFoodReportByFoodId($id)
    {
        return parent::getFoodReportByFoodId($id);
    }

    public function searchFoodByName($name)
    {
        return parent::searchFoodByName($name);
    }
}
