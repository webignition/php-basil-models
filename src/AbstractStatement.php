<?php

declare(strict_types=1);

namespace webignition\BasilModel;

abstract class AbstractStatement implements StatementInterface
{
    private $source = '';

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    public function getSource(): string
    {
        return $this->source;
    }
}
