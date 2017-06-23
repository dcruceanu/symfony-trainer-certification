<?php


namespace NdbApiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class OverrideServiceCompilerPass
 *
 * @package NdbApiBundle\DependencyInjection\Compiler
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 */
class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $containerBuilder)
    {
        $foodManagerService = $containerBuilder->getDefinition('food_manager_service');
        $foodManagerService->setClass('TestApiBundle\Service\FoodManagerService');
    }
}
