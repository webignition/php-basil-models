<?php

namespace webignition\BasilModel\DataSet;

interface DataSetInterface
{
    public function getParameterValue(string $parameterName): ?string;

    /**
     * @return string[]
     */
    public function getParameterNames(): array;

    /**
     * @param string[] $parameterNames
     *
     * @return bool
     */
    public function hasParameterNames(array $parameterNames): bool;
}
