<?php

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    try {
        return $containerBuilder->build();
    } catch (Exception $e) {
        trigger_error($e->getMessage(), E_USER_ERROR);
    }
};
