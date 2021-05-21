<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->name('app')
    ->exclude('vendor');

return (new PhpCsFixer\Config())
    ->setFinder($finder)
    ->setRules([
        '@Symfony' => true,
        'class_attributes_separation' => true,
        'concat_space' => ['spacing' => 'one'],
        'echo_tag_syntax' => ['format' => 'short'],
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline', 'after_heredoc' => true],
        'blank_line_before_statement' => false,
        'no_extra_blank_lines' => ['tokens' => ['break', 'case', 'continue', 'curly_brace_block', 'default', 'extra', 'parenthesis_brace_block', 'return', 'square_brace_block', 'switch', 'throw', 'use', 'use_trait']],
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_tag_type' => true,
        'protected_to_private' => false,
        'trailing_comma_in_multiline' => ['after_heredoc' => true, 'elements' => ['arrays', 'arguments', 'parameters']],
        'whitespace_after_comma_in_array' => false,
        /* @Symfony:risky */
        'combine_nested_dirname' => true,
        'dir_constant' => true,
        'function_to_constant' => true,
        'implode_call' => true,
        'is_null' => true,
        'logical_operators' => true,
        'modernize_types_casting' => true,
        'no_alias_functions' => true,
        'no_homoglyph_names' => true,
        'no_php4_constructor' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_sprintf' => true,
        'non_printable_character' => true,
        'ordered_traits' => true,
        'set_type_to_cast' => true,
        'string_line_ending' => true,
        'ternary_to_elvis_operator' => true,
        /* misc */
        'new_with_braces' => true,
        'no_leading_import_slash' => true,
        'multiline_whitespace_before_semicolons' => true,
        'no_whitespace_in_blank_line' => true,
        'ternary_operator_spaces' => true,
    ]);
