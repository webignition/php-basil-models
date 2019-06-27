<?php

namespace webignition\BasilModel\Action;

interface WaitActionInterface extends ActionInterface
{
    public function getDuration(): string;
}
