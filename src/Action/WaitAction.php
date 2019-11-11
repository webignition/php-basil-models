<?php

declare(strict_types=1);

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Value\ValueInterface;

class WaitAction extends AbstractAction implements WaitActionInterface
{
    private $duration;

    public function __construct(string $actionString, ValueInterface $duration)
    {
        parent::__construct($actionString, ActionTypes::WAIT, (string) $duration, true);

        $this->duration = $duration;
    }

    public function getArguments(): string
    {
        return trim(parent::getArguments(), '"');
    }

    public function getDuration(): ValueInterface
    {
        return $this->duration;
    }
}
