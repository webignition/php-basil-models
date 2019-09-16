<?php
/** @noinspection PhpDocSignatureInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace webignition\BasilModel\Tests\Unit\Assertion;

use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Assertion\ExaminationAssertion;
use webignition\BasilModel\Identifier\PageObjectIdentifier;
use webignition\BasilModel\Value\Assertion\ExaminedValue;
use webignition\BasilModel\Value\Assertion\ExaminedValueInterface;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\ElementValue;

class ExaminationAssertionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $assertionString,
        ExaminedValueInterface $examinedValue,
        string $comparison
    ) {
        $assertion = new ExaminationAssertion($assertionString, $examinedValue, $comparison);

        $this->assertSame($assertionString, $assertion->getAssertionString());
        $this->assertSame($examinedValue, $assertion->getExaminedValue());
        $this->assertSame($comparison, $assertion->getComparison());
    }

    public function createDataProvider(): array
    {
        $examinedValue = new ExaminedValue(
            new ElementValue(
                new PageObjectIdentifier(
                    new ElementExpression('.examined', ElementExpressionType::CSS_SELECTOR)
                )
            )
        );

        return [
            'exists comparison' => [
                'assertionString' => '".examined" exists',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::EXISTS,
            ],
            'not-exists comparison' => [
                'assertionString' => '".examined" exists',
                'examinedValue' => $examinedValue,
                'comparison' => AssertionComparison::NOT_EXISTS,
            ],
        ];
    }

    public function testWithExaminedValue()
    {
        $originalExaminedValue = new ExaminedValue(
            new ElementValue(
                new PageObjectIdentifier(
                    new ElementExpression('.original', ElementExpressionType::CSS_SELECTOR)
                )
            )
        );

        $newExaminedValue = new ExaminedValue(
            new ElementValue(
                new PageObjectIdentifier(
                    new ElementExpression('.new', ElementExpressionType::CSS_SELECTOR)
                )
            )
        );

        $assertion = new ExaminationAssertion(
            '".selector" exists',
            $originalExaminedValue,
            AssertionComparison::IS
        );

        $mutatedAssertion = $assertion->withExaminedValue($newExaminedValue);

        $this->assertNotSame($assertion, $mutatedAssertion);
        $this->assertSame($newExaminedValue, $mutatedAssertion->getExaminedValue());
    }
}
