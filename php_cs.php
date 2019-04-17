<?php

declare(strict_types=1);

return PhpCsFixer\Config::create()
    ->setRules([
        // General fixers
        'psr0' => false,
        '@Symfony' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'not_operator_with_successor_space' => true,
        'ordered_imports' => true,
        'linebreak_after_opening_tag' => true,
        'method_argument_space' => [
            'keep_multiple_spaces_after_comma' => true,
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'fopen_flags' => true,
        // 'heredoc_indentation' => true, // Can be enabled on PHP >= 7.3 environment
        'list_syntax' => [
            'syntax' => 'short',
        ],
        // @PhpCsFixer:risky
        'logical_operators' => true,
        // @PHP71Migration
        'ternary_to_null_coalescing' => true,
        // @PHP71Migration:risky
        'void_return' => true,
        'random_api_migration' => true,
        'pow_to_exponentiation' => true,
        'declare_strict_types' => true,
        // @Symfony overrides
        'concat_space' => [
            'spacing' => 'one',
        ],
        // @Symfony:risky
        'is_null' => true,
        'modernize_types_casting' => true,
        'dir_constant' => true,
        'non_printable_character' => [
            'use_escape_sequences_in_strings' => false,
        ],
        'self_accessor' => true,
        'no_alias_functions' => true,
        'function_to_constant' => true,
        'ereg_to_preg' => true,
        'fopen_flag_order' => true,
        'implode_call' => true,
        'native_function_invocation' => [
            'include' => [
                '@compiler_optimized',
            ],
            'scope' => 'namespaced',
            'strict' => true,
        ],
        'php_unit_construct' => true,
        // PHPUnit
        'php_unit_method_casing' => [
            'case' => 'snake_case',
        ],
        'php_unit_test_annotation' => [
            'style' => 'annotation',
        ],
        // PHPDoc
        'phpdoc_align' => [
            'align' => 'left',
        ],
        'phpdoc_order' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
            ->exclude([
                'bootstrap/cache',
                'bower_components',
                'node_modules',
                'tasks',
                'public',
                'bin',
                'storage',
                'vendor',
            ])
            ->notPath('_ide_helper_models.php')
            ->notPath('_ide_helper.php')
            ->notPath('.phpstorm.meta.php')
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
    );
