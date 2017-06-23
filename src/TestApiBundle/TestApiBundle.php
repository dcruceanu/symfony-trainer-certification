<?php


namespace TestApiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class TestApiBundle
 *
 * @package TestApiBundle
 * @author  Cruceanu Daniela <daniela.cruceanu@cegeka.com>
 */
class TestApiBundle extends Bundle
{
    public function getParent()
    {
        return 'NdbApiBundle';
    }
}
