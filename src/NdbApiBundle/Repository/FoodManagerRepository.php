<?php

namespace NdbApiBundle\Repository;

/**
 * Class FoodManagerRepository
 *
 * @package NdbApiBundle\Repository
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 */
class FoodManagerRepository extends BaseRepository
{
    public function getFoodReportByFoodId($id)
    {
        // Make a get request to get the report for that food
        return $this->doRequest('GET', $this->makeUrl("reports", [
            'ndbno' => $id
        ]))->getBody()->getContents();
    }

    public function searchFoodByName($name)
    {
        // Make a get request to search for that food
        return $this->doRequest('GET', $this->makeUrl("search", [
            'q' => $name . " raw"
        ]))->getBody()->getContents();
    }
}
