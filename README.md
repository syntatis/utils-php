<div align="center">
  <strong>📦 utils-php</strong>
  <p>Handy functions for PHP</p>

  ![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/syntatis/utils/php?color=%237A86B8) [![php](https://github.com/syntatis/utils-php/actions/workflows/php.yml/badge.svg)](https://github.com/syntatis/utils-php/actions/workflows/php.yml) [![codecov](https://codecov.io/gh/syntatis/utils-php/graph/badge.svg?token=QH387BY1PK)](https://codecov.io/gh/syntatis/utils-php) ![Packagist Downloads](https://img.shields.io/packagist/dt/syntatis/utils)

</div>

---

## Installation

```bash
composer require syntatis/utils
```

## Usagex

### Validator

This PHP package includes a number of functions to perform common value validation, such as if a value is an email, URL, or not being blank.

| Function | Description |
| --- | --- |
| `is_blank` | Validates whether a value is blank or empty. |
| `is_email` | Validates whether a value is a valid email address. |
| `is_url` | Validates whether a value is a valid URL. |
| `is_uuid` | Validates whether a value is a valid UUID. |
| `is_semver` | Validates whether a value is a valid SemVer format. |
| `is_ip_address` | Validates whether a value is a valid IPv4 or IPv6 address. |
| `is_unique` | Validates that all elements in the provided collection are unique. |

#### Examples

```php
use function Syntatis\Utils\is_blank;
use function Syntatis\Utils\is_email;

// Whether a value is blank or empty.
is_blank(''); // `true`.
is_blank(' '); // `true`.
is_blank('foo '); // `false`.
```

### Case Converter

These functions are functions to convert a string to a specific case, such as camel case, snake case, or kebab case.

| Function | Description |
| --- | --- |
| `camelcased` | Converts a string to camel case e.g. `foo_bar` to `fooBar`. |
| `snakecased` | Converts a string to snake case e.g. `fooBar` to `foo_bar`. |
| `kebabcased` | Converts a string to kebab case e.g. `fooBar` to `foo-bar`. |
| `pascalecased` | Converts a string to pascal case e.g. `foo_bar` to `FooBar`. |
| `titlecased` | Converts a string to title case e.g. `foo_bar` to `Foo Bar`. |
| `sentencecased` | Converts a string to sentence case e.g. `foo_bar` to `Foo bar`. |
| `lowercased` | Converts a string to lower case e.g. `FooBar` to `foobar`. |
| `uppercased` | Converts a string to upper case e.g. `fooBar` to `FOOBAR`. |
| `macrocased` | Converts a string to macro case e.g. `fooBar` to `FOO_BAR`. |
| `cobolcased` | Converts a string to cobol case e.g. `fooBar` to `FOO-BAR`. |

#### Examples

```php
use function Syntatis\Utils\camelcased;

// Converts a string to camel case.
camelcased('foo_bar'); // `fooBar`.
```

### Inflector

These are functions to perform common inflection tasks, such as pluralizing or singularizing a word.

| Function | Description |
| --- | --- |
| `pluralize` | Pluralizes a word e.g. `apple` to `apples`. |
| `singularize` | Singularizes a word e.g. `apples` to `apple`. |
| `slugify` | Slugifies a string e.g. `Hello, World!` to `hello-world`. |

#### Examples

```php
use function Syntatis\Utils\pluralize;

// Pluralizes a word.
pluralize('apple'); // `apples`.
```
