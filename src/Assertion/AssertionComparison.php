<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\Exception\InvalidComparisonException;

class AssertionComparison implements AssertionComparisonInterface
{
    const IS = 'is';
    const IS_NOT = 'is-not';
    const EXISTS = 'exists';
    const NOT_EXISTS = 'not-exists';
    const INCLUDES = 'includes';
    const EXCLUDES = 'excludes';
    const MATCHES = 'matches';

    const ALL = [
        self::IS,
        self::IS_NOT,
        self::EXISTS,
        self::NOT_EXISTS,
        self::INCLUDES,
        self::EXCLUDES,
        self::MATCHES,
    ];

    private $value = '';

    /**
     * @param string $value
     *
     * @throws InvalidComparisonException
     */
    public function __construct(string $value)
    {
        if (!in_array($value, self::ALL)) {
            throw new InvalidComparisonException($value);
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
