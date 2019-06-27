<?php

namespace webignition\BasilModel\Assertion;

class AssertionComparisons
{
    const IS = 'is';
    const IS_NOT = 'is-not';
    const EXISTS = 'exists';
    const NOT_EXISTS = 'not-exists';
    const INCLUDES = 'includes';
    const EXCLUDES = 'excludes';
    const MATCHES = 'matches';

    const NO_VALUE_TYPES = [
        self::EXISTS,
        self::NOT_EXISTS,
    ];

    const ALL = [
        self::IS,
        self::IS_NOT,
        self::EXISTS,
        self::NOT_EXISTS,
        self::INCLUDES,
        self::EXCLUDES,
        self::MATCHES,
    ];
}
