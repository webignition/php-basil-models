<?php

namespace webignition\BasilModel\Assertion;

use webignition\BasilModel\AbstractStatement;

abstract class AbstractAssertion extends AbstractStatement implements AssertionInterface
{
    private $comparison;

    public function __construct(string $source, string $comparison)
    {
        parent::__construct($source);

        $this->comparison = $comparison;
    }

    public function getComparison(): string
    {
        return $this->comparison;
    }
}
