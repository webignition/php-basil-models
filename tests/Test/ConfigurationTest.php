<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Test;

use webignition\BasilModel\Test\Configuration;

class ConfigurationTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $browser = 'chrome';
        $uri = 'http://example.com/';

        $configuration = new Configuration($browser, $uri);

        $this->assertSame($browser, $configuration->getBrowser());
        $this->assertSame($uri, $configuration->getUrl());
    }
}
