<?php

namespace webignition\BasilModel\Action;

class WaitAction extends AbstractAction implements WaitActionInterface
{
    private $duration;

    public function __construct(string $duration)
    {
        parent::__construct(ActionTypes::WAIT, $duration, true);

        $this->duration = $duration;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }
}
