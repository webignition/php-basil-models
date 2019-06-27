<?php

namespace webignition\BasilModel\DataSet;

interface DataSetInterface
{
    public function getParameterValue(string $parameterName): ?string;

    /**
     * @return string[]
     */
    public function getParameterNames(): array;
}
