<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Test;

use webignition\BasilModel\Test\ImportCollection;
use webignition\BasilModel\Test\ImportCollectionInterface;

class ImportCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(array $importPaths, ImportCollectionInterface $expectedImportCollection)
    {
        $importCollection = new ImportCollection($importPaths);

        $this->assertEquals($expectedImportCollection, $importCollection);
    }

    public function createDataProvider(): array
    {
        return [
            'no imports' => [
                'importPaths' => [],
                'expectedImportCollection' => new ImportCollection([]),
            ],
            'invalid imports' => [
                'importPaths' => [
                    1,
                    2,
                    true,
                    false,
                ],
                'expectedImportCollection' => new ImportCollection([]),
            ],
            'valid and invalid imports' => [
                'importPaths' => [
                    'invalid1' => 1,
                    'invalid2' => 2,
                    'page' => '../page/example.com.yml',
                ],
                'expectedImportCollection' => new ImportCollection(
                    [
                        'page' => '../page/example.com.yml',
                    ]
                ),
            ],
        ];
    }

    public function testGetImportPath()
    {
        $importCollection = new ImportCollection([
            'page1' => '../page/1.example.com.yml',
            'page2' => '../page/2.example.com.yml',
        ]);

        $this->assertEquals('../page/1.example.com.yml', $importCollection->getImportPath('page1'));
        $this->assertEquals('../page/2.example.com.yml', $importCollection->getImportPath('page2'));
        $this->assertNull($importCollection->getImportPath('page3'));
    }
}
