<?php

declare(strict_types=1);

namespace webignition\BasilModel\Test;

interface ConfigurationInterface
{
    public function getBrowser(): string;
    public function getUrl(): string;
}
