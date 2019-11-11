<?php

declare(strict_types=1);

namespace webignition\BasilModel\Action;

use webignition\BasilModel\Value\ValueInterface;

interface WaitActionInterface extends ActionInterface
{
    public function getDuration(): ValueInterface;
}
