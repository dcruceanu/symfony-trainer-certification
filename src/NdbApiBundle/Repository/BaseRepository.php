<?php


namespace NdbApiBundle\Repository;

use GuzzleHttp\Client;

/**
 * Contains base operations to our endpoint
 *
 * @package NdbApiBundle\Repository
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 */
abstract class BaseRepository extends AbstractRestRepository
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $ndbBaseUrl;

    /**
     * @var string
     */
    protected $ndbApiKey;

    function __construct($ndbBaseUrl, $ndbApiKey)
    {
        parent::__construct(new Client());
        $this->client     = new Client();
        $this->ndbBaseUrl = $ndbBaseUrl;
        $this->ndbApiKey  = $ndbApiKey;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     *
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Builds the url with the given parameters
     *
     * @param string $resource
     * @param array $params
     *
     * @return string
     */
    public function makeUrl($resource, $params = [])
    {
        if(null !== $resource) {
            $fullUrl = $this->ndbBaseUrl . "/{$resource}?";
        }

        /* Add the default parameters which will be on each request */
        $params = $params + [
                "api_key" => $this->ndbApiKey,
                "format" => 'json',
                "max" => 25,
                "offset" => 0
            ];

        $fullUrl = $fullUrl . http_build_query($params);

        return $fullUrl;
    }

}
