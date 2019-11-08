<?php

declare(strict_types=1);

namespace webignition\BasilModel\Action;

class UnrecognisedAction extends AbstractAction
{
    public function __construct(string $actionString, string $type, string $arguments)
    {
        parent::__construct($actionString, $type, $arguments, false);
    }
}
