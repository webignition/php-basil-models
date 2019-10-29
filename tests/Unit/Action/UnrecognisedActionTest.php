<?php

namespace webignition\BasilModel\Tests\Unit\Action;

use webignition\BasilModel\Action\UnrecognisedAction;

class UnrecognisedActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $action = new UnrecognisedAction('foo', 'foo', '');

        $this->assertSame('foo', $action->getType());
        $this->assertSame('', $action->getArguments());
        $this->assertFalse($action->isRecognised());
        $this->assertSame('foo', $action->getSource());
    }
}
