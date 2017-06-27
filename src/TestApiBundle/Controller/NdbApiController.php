<?php


namespace TestApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route("/details", name="getBundlesInfo")
     *
     * @return Response
     */
    public function getKernelDetailsAction()
    {
        $bundles = $this->get('kernel')->getBundles();
        $bundles = $this->container->getParameter('kernel.bundles');

        $rootDirectory = $this->get('kernel')->getRootDir();
        $cacheDirectory = $this->get('kernel')->getCacheDir();
        $logsDirectory = $this->get('kernel')->getLogDir();
        $environment = $this->get('kernel')->getEnvironment();
        $debug = $this->get('kernel')->isDebug();
        $name = $this->get('kernel')->getName();
        $charset = $this->get('kernel')->getCharset();
        $container = $this->get('kernel')->getContainer();
        $containerClass = get_class($container);

        return $this->render('test/bundles.html.twig', [
            'bundles' => $bundles,
            'details' => [
                'Root directory' => $rootDirectory,
                'Cache directory' => $cacheDirectory,
                'Logs directory' => $logsDirectory,
                'Environment' => $environment,
                'Debug' => $debug,
                'Name' => $name,
                'Charset'=> $charset,
                'Container class'=> $containerClass,
            ]
        ]);
    }
}
