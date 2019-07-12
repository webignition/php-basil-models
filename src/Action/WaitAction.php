<?php

namespace webignition\BasilModel\Action;

class WaitAction extends AbstractAction implements WaitActionInterface
{
    private $duration;

    public function __construct(string $actionString, string $duration)
    {
        parent::__construct($actionString, ActionTypes::WAIT, $duration, true);

        $this->duration = $duration;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }
}
