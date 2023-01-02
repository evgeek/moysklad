<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude('Enums')
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
        'phpdoc_summary' => false,
        'global_namespace_import' => false,
        'explicit_string_variable' => false,
        'yoda_style' => false,
        'concat_space' => false,
        'multiline_whitespace_before_semicolons' => false,
//        'strict_param' => true,
//        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder);