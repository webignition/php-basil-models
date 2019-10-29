<?php

namespace webignition\BasilModel\Assertion;

abstract class AbstractAssertion implements AssertionInterface
{
    private $source;
    private $comparison;

    public function __construct(string $assertionString, string $comparison)
    {
        $this->source = $assertionString;
        $this->comparison = $comparison;
    }

    public function getComparison(): string
    {
        return $this->comparison;
    }

    public function getSource(): string
    {
        return $this->source;
    }
}
