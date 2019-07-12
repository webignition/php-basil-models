<?php

namespace webignition\BasilModel\Action;

abstract class AbstractAction implements ActionInterface
{
    private $actionString = '';
    private $type = '';
    private $arguments = '';
    private $isRecognised = false;

    public function __construct(string $actionString, string $type, string $arguments, bool $isRecognised = false)
    {
        $this->actionString = $actionString;
        $this->type = $type;
        $this->arguments = $arguments;
        $this->isRecognised = $isRecognised;
    }

    public function getActionString(): string
    {
        return $this->actionString;
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
