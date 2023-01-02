<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude('Enums')
;

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,

        'phpdoc_summary' => false,
        'global_namespace_import' => false,
        'explicit_string_variable' => false,
        'yoda_style' => false,
        'concat_space' => false,
        'multiline_whitespace_before_semicolons' => false,
        'native_function_invocation' => false,
    ])
    ->setFinder($finder);