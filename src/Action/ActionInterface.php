<?php

namespace webignition\BasilModel\Action;

use webignition\BasilModel\StatementInterface;

interface ActionInterface extends StatementInterface
{
    public function getActionString(): string;
    public function getType(): string;
    public function getArguments(): string;
    public function isRecognised(): bool;
}
