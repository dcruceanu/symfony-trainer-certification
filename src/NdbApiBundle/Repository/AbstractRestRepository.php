<?php

namespace NdbApiBundle\Repository;

use GuzzleHttp\Client;

abstract class AbstractRestRepository
{
    /**
     * @var Client
     */
    protected $guzzle;

    /**
     * AbstractRestRepository constructor.
     *
     * @param $guzzle
     */
    public function __construct($guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function doRequest($method, $url, array $options = [])
    {
        $response  = $this->guzzle->request($method, $url, $options);

        return $response;
    }
}
