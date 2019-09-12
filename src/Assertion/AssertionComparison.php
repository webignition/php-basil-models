<?php

namespace webignition\BasilModel\Assertion;

class AssertionComparison
{
    const IS = 'is';
    const IS_NOT = 'is-not';
    const EXISTS = 'exists';
    const NOT_EXISTS = 'not-exists';
    const INCLUDES = 'includes';
    const EXCLUDES = 'excludes';
    const MATCHES = 'matches';

    const EXAMINATION_COMPARISONS = [
        self::EXISTS,
        self::NOT_EXISTS,
    ];

    const COMPARISON_COMPARISONS = [
        self::IS,
        self::IS_NOT,
        self::INCLUDES,
        self::EXCLUDES,
        self::MATCHES
    ];
}
