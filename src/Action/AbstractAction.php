<?php

declare(strict_types=1);

namespace webignition\BasilModel\Action;

use webignition\BasilModel\AbstractStatement;

abstract class AbstractAction extends AbstractStatement implements ActionInterface
{
    private $type = '';
    private $arguments = '';
    private $isRecognised = false;

    public function __construct(string $source, string $type, string $arguments, bool $isRecognised = false)
    {
        parent::__construct($source);

        $this->type = $type;
        $this->arguments = $arguments;
        $this->isRecognised = $isRecognised;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getArguments(): string
    {
        return $this->arguments;
    }

    public function isRecognised(): bool
    {
        return $this->isRecognised;
    }
}
