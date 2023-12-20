<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Remarkablemark\RectorLaravelDatabaseExpressions\LaravelDatabaseExpressionsRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(LaravelDatabaseExpressionsRector::class);
};
