# Changelog

## [2.0.1](https://github.com/remarkablemark/rector-laravel-database-expressions/compare/v2.0.0...v2.0.1) (2025-03-07)


### Miscellaneous Chores

* **github:** delete FUNDING.yml ([b6e83fd](https://github.com/remarkablemark/rector-laravel-database-expressions/commit/b6e83fd9075c06d47c35c047a7e588cb8371c124))

## [2.0.0](https://github.com/remarkablemark/rector-laravel-database-expressions/compare/v1.1.0...v2.0.0) (2024-02-26)


### ⚠ BREAKING CHANGES

* update import to support rector v1

### Code Refactoring

* update rector import ([7631606](https://github.com/remarkablemark/rector-laravel-database-expressions/commit/76316062383d03af3f8fdc2492e4cd2fe866bc58))

## [1.1.0](https://github.com/remarkablemark/rector-laravel-database-expressions/compare/v1.0.4...v1.1.0) (2023-12-23)


### Features

* replace `DB::raw()` with first argument string ([e1972dc](https://github.com/remarkablemark/rector-laravel-database-expressions/commit/e1972dc8a3ab9beb080e74691da74d0cf5c41886))

## [1.0.4](https://github.com/remarkablemark/rector-laravel-database-expressions/compare/v1.0.3...v1.0.4) (2023-12-23)


### Bug Fixes

* revert `DB::raw` inside `DB::select` regression ([6d99dfa](https://github.com/remarkablemark/rector-laravel-database-expressions/commit/6d99dfab643deab1b03bc2fb280c52f750086b72))

## [1.0.3](https://github.com/remarkablemark/rector-laravel-database-expressions/compare/v1.0.2...v1.0.3) (2023-12-23)


### Bug Fixes

* refactor only when `DB::raw` is inside of a `*Raw` method ([81f70eb](https://github.com/remarkablemark/rector-laravel-database-expressions/commit/81f70eb027db44569f1131e7102dc27884e0c589))

## [1.0.2](https://github.com/remarkablemark/rector-laravel-database-expressions/compare/v1.0.1...v1.0.2) (2023-12-23)


### Build System

* **composer:** drop support for PHP 7 and support only PHP &gt;=8.0 ([0b5bd5b](https://github.com/remarkablemark/rector-laravel-database-expressions/commit/0b5bd5b318b749fb2390f179cdae55cfda74edd9))

## [1.0.1](https://github.com/remarkablemark/rector-laravel-database-expressions/compare/v1.0.0...v1.0.1) (2023-12-20)


### Miscellaneous Chores

* **composer:** add keyword "codemod" ([3014716](https://github.com/remarkablemark/rector-laravel-database-expressions/commit/30147161f9ac8c4804dcc44dc5f90d5511cd1c8b))

## 1.0.0 (2023-12-20)


### Features

* add Laravel database expressions rector ([36d64b7](https://github.com/remarkablemark/rector-laravel-database-expressions/commit/36d64b7205d66a57cecf29d3b2c10102031fd59e))
