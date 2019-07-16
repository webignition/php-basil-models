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
        foreach ($dataSets as $dataSetIndex => $dataSet) {
            $this[$dataSetIndex] = $dataSet;
        }

        $this->iteratorPosition = 0;
    }

    public static function fromArray(array $data): DataSetCollectionInterface
    {
        $dataSetCollection = new DataSetCollection();

        foreach ($data as $dataSetIndex => $dataSet) {
            if (is_array($dataSet)) {
                $dataSetCollection[$dataSetIndex] = new DataSet($dataSet);
            }
        }

        return $dataSetCollection;
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

    // \ArrayAccess methods

    public function offsetSet($offset, $value)
    {
        if ($value instanceof DataSetInterface) {
            if (is_null($offset)) {
                $this->dataSets[] = $value;
            } else {
                $this->dataSets[$offset] = $value;
            }
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->dataSets[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->dataSets[$offset]);
    }

    public function offsetGet($offset): ?DataSetInterface
    {
        return $this->dataSets[$offset] ?? null;
    }
}
