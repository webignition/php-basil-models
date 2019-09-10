<?php

namespace webignition\BasilModel\Tests\Unit\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\NoArgumentsAction;

class NoArgumentsActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $type = 'reload';

        $action = new NoArgumentsAction('reload', $type, '');

        $this->assertSame(ActionTypes::RELOAD, $action->getType());
        $this->assertSame('', $action->getArguments());
        $this->assertTrue($action->isRecognised());
        $this->assertSame('reload', $action->getActionString());
    }
}
