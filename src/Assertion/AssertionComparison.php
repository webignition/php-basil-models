<?php

declare(strict_types=1);

namespace webignition\BasilModel\Assertion;

class AssertionComparison
{
    public const IS = 'is';
    public const IS_NOT = 'is-not';
    public const EXISTS = 'exists';
    public const NOT_EXISTS = 'not-exists';
    public const INCLUDES = 'includes';
    public const EXCLUDES = 'excludes';
    public const MATCHES = 'matches';

    public const EXAMINATION_COMPARISONS = [
        self::EXISTS,
        self::NOT_EXISTS,
    ];

    public const COMPARISON_COMPARISONS = [
        self::IS,
        self::IS_NOT,
        self::INCLUDES,
        self::EXCLUDES,
        self::MATCHES
    ];
}
