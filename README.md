# rector-laravel-database-expressions

[![packagist](https://img.shields.io/packagist/v/remarkablemark/rector-laravel-database-expressions)](https://packagist.org/packages/remarkablemark/rector-laravel-database-expressions)
[![test](https://github.com/remarkablemark/rector-laravel-database-expressions/actions/workflows/test.yml/badge.svg)](https://github.com/remarkablemark/rector-laravel-database-expressions/actions/workflows/test.yml)

[Rector](https://github.com/rectorphp/rector) to refactor Laravel 10 database expressions.

From [Laravel 10](https://laravel.com/docs/10.x/upgrade#database-expressions):

> Database "expressions" (typically generated via `DB::raw`) have been rewritten in Laravel 10.x to offer additional functionality in the future. Notably, the grammar's raw string value must now be retrieved via the expression's `getValue(Grammar $grammar)` method. Casting an expression to a string using `(string)` is no longer supported.
>
> If your application is manually casting database expressions to strings using `(string)` or invoking the `__toString` method on the expression directly, you should update your code to invoke the `getValue` method instead:
>
> ```php
> use Illuminate\Support\Facades\DB;
>
> $expression = DB::raw('select 1');
>
> $string = $expression->getValue(DB::connection()->getQueryGrammar());
> ```

## Requirements

PHP >=7.2

## Install

Install with [Composer](http://getcomposer.org/):

```sh
composer require --dev rector/rector remarkablemark/rector-laravel-database-expressions
```

## Usage

Register rule in `rector.php`:

```php
<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Remarkablemark\RectorLaravelDatabaseExpressions\LaravelDatabaseExpressionsRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/tests',
    ]);
    $rectorConfig->rule(LaravelDatabaseExpressionsRector::class);
};
```

See the diff:

```php
vendor/bin/rector process --dry-run
```

Apply the rule:

```php
vendor/bin/rector process
```

Clear the cache and apply the rule:

```php
vendor/bin/rector process --clear-cache
```

## Rule

### Before

```php
DB::select(DB::raw('select 1'));
```

### After

```php
DB::select(DB::raw('select 1')->getValue(DB::getQueryGrammar()));
```

## License

[MIT](LICENSE)
