<?php

namespace webignition\BasilModel\DataSet;

class DataSetCollection implements DataSetCollectionInterface
{
    /**
     * @var DataSetInterface[]
     */
    private $dataSets = [];

    private $iteratorPosition = 0;

    public function __construct(array $dataSets = [])
    {
        foreach ($dataSets as $dataSet) {
            if ($dataSet instanceof DataSetInterface) {
                $this->addDataSet($dataSet);
            }
        }

        $this->iteratorPosition = 0;
    }

    public static function fromArray(array $data): DataSetCollectionInterface
    {
        $dataSetCollection = new DataSetCollection();

        foreach ($data as $dataSetName => $dataSet) {
            if (is_array($dataSet)) {
                $dataSetCollection->addDataSet(new DataSet((string) $dataSetName, $dataSet));
            }
        }

        return $dataSetCollection;
    }

    public function addDataSet(DataSetInterface $dataSet)
    {
        $this->dataSets[] = $dataSet;
    }

    // \Countable methods

    public function count(): int
    {
        return count($this->dataSets);
    }

    // Iterator methods

    public function rewind()
    {
        $this->iteratorPosition = 0;
    }

    public function current(): DataSetInterface
    {
        return $this->dataSets[$this->iteratorPosition];
    }

    public function key(): int
    {
        return $this->iteratorPosition;
    }

    public function next()
    {
        ++$this->iteratorPosition;
    }

    public function valid(): bool
    {
        return isset($this->dataSets[$this->iteratorPosition]);
    }
}
