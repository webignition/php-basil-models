<?php

namespace webignition\BasilModel\Action;

abstract class AbstractAction implements ActionInterface
{
    private $type = '';
    private $arguments = '';
    private $isRecognised = false;

    public function __construct(string $type, string $arguments, bool $isRecognised = false)
    {
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
