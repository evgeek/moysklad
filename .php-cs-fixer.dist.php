<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
;

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true,
        '@PSR12:risky' => true,
        '@PHP80Migration:risky' => true,
        '@PHP81Migration' => true,
        '@PHPUnit84Migration:risky' => true,
        '@PhpCsFixer' => true,
//        'strict_param' => true,
//        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder);