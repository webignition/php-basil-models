<?php

namespace webignition\BasilModel\Tests\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\UnrecognisedAction;

class UnrecognisedActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $type = ActionTypes::RELOAD;

        $action = new UnrecognisedAction($type, '');

        $this->assertSame($type, $action->getType());
        $this->assertSame('', $action->getArguments());
        $this->assertFalse($action->isRecognised());
    }
}
