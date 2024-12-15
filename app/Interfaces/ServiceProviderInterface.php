<?php

namespace App\Interfaces;

use DI\ContainerBuilder;

interface ServiceProviderInterface
{
    public function register(ContainerBuilder $containerBuilder): void;
}
