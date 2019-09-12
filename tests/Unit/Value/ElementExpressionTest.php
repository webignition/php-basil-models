<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Value;

use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class ElementExpressionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $expression, string $type)
    {
        $elementExpression = new ElementExpression($expression, $type);

        $this->assertSame($expression, $elementExpression->getExpression());
        $this->assertSame($type, $elementExpression->getType());
        $this->assertTrue($elementExpression->isActionable());
    }

    public function createDataProvider(): array
    {
        return [
            'css selector' => [
                'expression' => '.selector',
                'type' => ElementExpressionType::CSS_SELECTOR,
            ],
            'xpath expression' => [
                'expression' => '//h1',
                'type' => ElementExpressionType::XPATH_EXPRESSION,
            ],
        ];
    }

    public function testIsEmpty()
    {
        $this->assertFalse((new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR))->isEmpty());
        $this->assertTrue((new ElementExpression('', ElementExpressionType::CSS_SELECTOR))->isEmpty());
    }

    public function testToString()
    {
        $this->assertSame(
            '".selector"',
            (string) (new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR))
        );
    }
}
