<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->in(['src', 'test']);

$config = new PhpCsFixer\Config();

$rules = [
    '@PSR12' => true,
    '@PhpCsFixer' => true,
    '@PhpCsFixer:risky' => true,
    '@Symfony' => true,
    '@PHP74Migration' => true,
    '@PHP74Migration:risky' => true,

    'date_time_immutable' => true,
    'protected_to_private' => true,

    'global_namespace_import' => [
        'import_constants' => true,
        'import_functions' => true,
        'import_classes' => true,
    ],

    // assertSame() requires same instance, which is not compatible with functional/immutable paradigm.
    'php_unit_strict' => false,
    'php_unit_test_class_requires_covers' => false,

    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],

    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
        'imports_order' => [
            'class',
            'function',
            'const',
        ],
    ],
];

return $config->setRules($rules)
    ->setFinder($finder)
    ->setRiskyAllowed(true);
