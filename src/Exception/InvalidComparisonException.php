<?php

declare(strict_types=1);

namespace webignition\BasilModel\Exception;

class InvalidComparisonException extends \Exception
{
    private $comparison;

    public function __construct(string $comparison)
    {
        parent::__construct('Invalid comparison "' . $comparison . '"');

        $this->comparison = $comparison;
    }

    public function getComparison(): string
    {
        return $this->comparison;
    }
}
