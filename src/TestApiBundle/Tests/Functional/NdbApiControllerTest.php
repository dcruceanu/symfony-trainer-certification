<?php


namespace TestApiBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NdbApiControllerTest
 *
 * @package TestApiBundle\Tests\Functional
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 */
class NdbApiControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client  = $this->createClient();
    }

    public function testCheckIfWeSearchForAFoodWeHaveTheLastSearchedFoodInTheCookie()
    {
        $this->client->request('GET', '/nbd_api_/search', [
            'name' => 'pineapple'
        ]);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $cookieJar = $this->client->getCookieJar();
        $this->assertEquals('pineapple', $cookieJar->get('Last_searched_food')->getValue());
    }

    public function testCheckIfWeSearchForAFoodThenAFlashIsSettedInTheFlashBag()
    {
        $this->client->request('GET', '/nbd_api_/search', [
            'name' => 'onion'
        ]);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        /* We are accessing the container in a functional test, don't do this at home haha */
        $flashBag = $this->client->getContainer()->get('session')->getFlashBag();

        $this->assertEquals('Your retrieval was successfully', $flashBag->get('notice')[0]);
    }
}
