<?php

namespace NdbApiBundle;

use NdbApiBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NdbApiBundle extends Bundle
{
    public function build(ContainerBuilder $containerBuilder)
    {
        parent::build($containerBuilder);
        
        $containerBuilder->addCompilerPass(new OverrideServiceCompilerPass());
    }
}
