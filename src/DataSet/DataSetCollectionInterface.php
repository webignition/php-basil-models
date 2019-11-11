<?php

declare(strict_types=1);

namespace webignition\BasilModel\DataSet;

interface DataSetCollectionInterface extends \Countable, \Iterator
{
    public static function fromArray(array $data): DataSetCollectionInterface;
    public function addDataSet(DataSetInterface $dataSet);

    /**
     * @return string[]
     */
    public function getParameterNames(): array;
}
