<?php

namespace webignition\BasilModel\Assertion;

abstract class AbstractAssertion implements AssertionInterface
{
    private $assertionString;
    private $comparison;

    public function __construct(string $assertionString, string $comparison)
    {
        $this->assertionString = $assertionString;
        $this->comparison = $comparison;
    }

    public function getAssertionString(): string
    {
        return $this->assertionString;
    }

    public function getComparison(): string
    {
        return $this->comparison;
    }
}
