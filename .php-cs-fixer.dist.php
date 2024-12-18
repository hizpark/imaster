<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/app')
    ->in(__DIR__ . '/bootstrap')
    ->in(__DIR__ . '/config')
    ->in(__DIR__ . '/modules')
    ->in(__DIR__ . '/routes')
    ->in(__DIR__ . '/tests');
return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder);
