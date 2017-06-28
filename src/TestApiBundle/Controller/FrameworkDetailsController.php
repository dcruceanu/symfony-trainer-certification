<?php


namespace TestApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FrameworkDetailsController
 *
 * @package TestApiBundle\Controller
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 */
class FrameworkDetailsController
{
    /**
     * Retrieve some details of the app structure
     * The purpose of this method is written to get used with retrieving info using the kernel
     *
     * @Route("/details", name="getBundlesInfo")
     *
     * @return Response
     */
    public function getKernelDetailsAction()
    {
        // two methods to get the bundles list
        $bundles = $this->get('kernel')->getBundles();
        $bundles = $this->container->getParameter('kernel.bundles');

        $rootDirectory  = $this->get('kernel')->getRootDir();
        $cacheDirectory = $this->get('kernel')->getCacheDir();
        $logsDirectory  = $this->get('kernel')->getLogDir();
        $environment    = $this->get('kernel')->getEnvironment();
        $debug          = $this->get('kernel')->isDebug();
        $name           = $this->get('kernel')->getName();
        $charset        = $this->get('kernel')->getCharset();
        $container      = $this->get('kernel')->getContainer();
        $containerClass = get_class($container);

        return $this->render('test/bundles.html.twig', [
            'bundles' => $bundles,
            'details' => [
                'Root directory'  => $rootDirectory,
                'Cache directory' => $cacheDirectory,
                'Logs directory'  => $logsDirectory,
                'Environment'     => $environment,
                'Debug'           => $debug,
                'Name'            => $name,
                'Charset'         => $charset,
                'Container class' => $containerClass,
            ]
        ]);
    }

    /**
     * @param Request $request
     * @Route("/requestInfo", name="requestInfo")
     * @Method({"GET", "POST"})
     *
     * @return Response
     */
    public function requestInfoAction(Request $request)
    {
        $arrayOfRawData = [];

        // Get all query params (GET)
        $queryParams = $request->query;

        // Get the default query parameter
        $queryDefaultParam = $request->query->get('default');

        // Get an array parameter
        $arrayQueryParameter = $request->query->get('arrayParam')['value'];

        // Get the raw data
        $requestContent = $request->getContent();

        if (null !== $requestContent) {
            $arrayOfRawData = json_decode($requestContent, true);
        }

        // Get the post params
        $postParams = $request->request;

        // Get the additional request attributes
        $attributes = $request->attributes;

        // Get the uploaded files
        $files = $request->files;

        // Get the request headers
        $headers = $request->headers;

        $view = $this->renderView(':test:controllers.html.twig', [
            'queryParams'    => $queryParams,
            'requestContent' => $arrayOfRawData,
            'postParams'     => $postParams,
            'files'          => $files,
            'headers'        => $headers,
        ]);

        return new Response($view);
    }

    /**
     * @Route("/basic", name= "basicAction")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function basicAction(Request $request)
    {
        return new Response();
    }
}
