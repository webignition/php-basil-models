<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Step;

use webignition\BasilModel\Action\WaitAction;
use webignition\BasilModel\Assertion\Assertion;
use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Step\PendingImportResolutionStep;
use webignition\BasilModel\Step\PendingImportResolutionStepInterface;
use webignition\BasilModel\Value\Value;
use webignition\BasilModel\Value\ValueTypes;

class PendingImportResolutionStepTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        array $actions,
        array $assertions,
        string $importName,
        string $dataProviderImportName,
        PendingImportResolutionStepInterface $expectedStep,
        bool $expectedRequiresResolution
    ) {
        $step = new PendingImportResolutionStep($actions, $assertions, $importName, $dataProviderImportName);

        $this->assertEquals($expectedStep, $step);
        $this->assertEquals($expectedRequiresResolution, $step->requiresResolution());
    }

    public function createDataProvider(): array
    {
        return [
            'empty' => [
                'actions' => [],
                'assertions' => [],
                'importName' => '',
                'dataProviderImportName' => '',
                'expectedStep' => new PendingImportResolutionStep([], [], '', ''),
                'expectedRequiresResolution' => false,
            ],
            'import name only' => [
                'actions' => [],
                'assertions' => [],
                'importName' => 'import_name',
                'dataProviderImportName' => '',
                'expectedStep' => new PendingImportResolutionStep([], [], 'import_name', ''),
                'expectedRequiresResolution' => true,
            ],
            'data provider import name only' => [
                'actions' => [],
                'assertions' => [],
                'importName' => '',
                'dataProviderImportName' => 'data_provider_import_name',
                'expectedStep' => new PendingImportResolutionStep([], [], '', 'data_provider_import_name'),
                'expectedRequiresResolution' => true,
            ],
            'import name and data provider import name' => [
                'actions' => [],
                'assertions' => [],
                'importName' => 'import_name',
                'dataProviderImportName' => 'data_provider_import_name',
                'expectedStep' => new PendingImportResolutionStep([], [], 'import_name', 'data_provider_import_name'),
                'expectedRequiresResolution' => true,
            ],
            'with actions and assertions' => [
                'actions' => [
                    new WaitAction('30')
                ],
                'assertions' => [
                    new Assertion(
                        '".selector" exists',
                        new Identifier(
                            IdentifierTypes::CSS_SELECTOR,
                            new Value(
                                ValueTypes::STRING,
                                '.selector'
                            )
                        ),
                        AssertionComparisons::EXISTS
                    ),
                ],
                'importName' => '',
                'dataProviderImportName' => '',
                'expectedStep' => new PendingImportResolutionStep(
                    [
                        new WaitAction('30')
                    ],
                    [
                        new Assertion(
                            '".selector" exists',
                            new Identifier(
                                IdentifierTypes::CSS_SELECTOR,
                                new Value(
                                    ValueTypes::STRING,
                                    '.selector'
                                )
                            ),
                            AssertionComparisons::EXISTS
                        ),
                    ],
                    '',
                    ''
                ),
                'expectedRequiresResolution' => false,
            ],
        ];
    }
}
