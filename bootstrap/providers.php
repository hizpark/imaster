<?php

use App\Providers\AppServiceProvider;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    (new AppServiceProvider())->register($containerBuilder);
};
