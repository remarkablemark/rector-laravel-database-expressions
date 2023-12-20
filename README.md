# rector-template

[![packagist](https://img.shields.io/packagist/v/remarkablemark/rector-template)](https://packagist.org/packages/remarkablemark/rector-template)
[![test](https://github.com/remarkablemark/rector-template/actions/workflows/test.yml/badge.svg)](https://github.com/remarkablemark/rector-template/actions/workflows/test.yml)

[Rector](https://github.com/rectorphp/rector) template

## Requirements

PHP >=7.2

## Install

Install with [Composer](http://getcomposer.org/):

```sh
composer require --dev rector/rector remarkablemark/rector-template
```

## Usage

Register rule in `rector.php`:

```php
<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Remarkablemark\RectorTemplate\ExampleRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ExampleRector::class);
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

## License

[MIT](LICENSE)
