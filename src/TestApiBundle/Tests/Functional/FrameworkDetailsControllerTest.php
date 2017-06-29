<?php


namespace TestApiBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\BrowserKit\Client;

/**
 * Class FrameworkDetailsControllerTest
 *
 * @package TestApiBundle\Tests\Functional
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 */
class FrameworkDetailsControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client  = $this->createClient();
    }

    public function testCheckIfWeProvideSomeQueryParametersThenWeFindItInTheReponse()
    {
        $crawler = $this->client->request('GET', '/framework/requestInfo', [
            'default' => 'Hello, query param!',
            'arrayParam[value]' => 'Hello, query array param!'
        ]);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $this->assertContains('Hello, query param!', $crawler->filter('#wrapper')->html());
        $this->assertContains('Hello, query array param!', $crawler->filter('#wrapper')->html());
    }

    public function testCheckIfWeProvideSomePostParametersThenWeFindItInTheReponse()
    {
        $crawler = $this->client->request('POST', '/framework/requestInfo', [
            'default' => 'Hello, post param!',
        ]);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $this->assertContains('Hello, post param!', $crawler->filter('#wrapper')->html());
        $this->assertNotContains("Hello, raw content", $crawler->filter("#wrapper")->html());
    }

    public function testCheckIfWeProvideSomeRawContentThenWeFindItInTheReponse()
    {
        $content = '{ "default": "Hello, raw content!" }';
        $crawler = $this->client->request('POST', '/framework/requestInfo', [], [], [], $content);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains("Hello, raw content", $crawler->filter("#wrapper")->html());
    }

    public function testCheckIfWePutACustomHeaderThenWeCanSeeItInTheResponse()
    {
        $crawler = $this->client->request('GET', '/framework/requestInfo', [], [], [
            'HTTP_Default_header' => 'Custom-header-value'
        ]);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Custom-header-value', $crawler->filter("#wrapper")->html());
    }

    public function testCheckIfWePutAFileInTheRequestThenWeCanSeeTheNameInTheResponse()
    {
        $file = new UploadedFile('composer.json', 'composer.json');

        $crawler = $this->client->request('POST', '/framework/requestInfo', [], [
            'uploadedFile' => $file
        ]);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains('File was provided', $crawler->html());
    }

    public function testCheckIfWeCallTheDetailsTempActionThenA302IsReturnedAsAStatusCode()
    {
        $this->client->request('GET', '/framework/details_temp_redirect');

        $this->assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
    }

    public function testCheckIfWeCallTheDetailsPermActionThenA301IsReturnedAsAStatusCode()
    {
        $this->client->request('GET', '/framework/details_perm_redirect');

        $this->assertEquals(Response::HTTP_MOVED_PERMANENTLY, $this->client->getResponse()->getStatusCode());
    }

    public function testCheckIfWeCallTheForwardActionThenA200IsReturnedAsAStatusCode()
    {
        $this->client->request('GET', '/framework/forward_get_food', [
            'name' => 'apple'
        ]);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testCheckIfWeCallTheForwardActionWithoutAParameterThenA404IsReturnedAsAStatusCode()
    {
        $this->client->request('GET', '/framework/forward_get_food');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }
}
