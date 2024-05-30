<div align="center">
  <strong>📦 utils-php</strong>
  <p>Handy functions for PHP</p>

  ![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/syntatis/utils/php?color=%237A86B8) [![php](https://github.com/syntatis/utils-php/actions/workflows/php.yml/badge.svg)](https://github.com/syntatis/utils-php/actions/workflows/php.yml) [![codecov](https://codecov.io/gh/syntatis/utils-php/graph/badge.svg?token=QH387BY1PK)](https://codecov.io/gh/syntatis/utils-php) ![Packagist Downloads](https://img.shields.io/packagist/dt/syntatis/utils)

</div>

---

The `syntatis/utils` package provides a variety of utility functions to simplify common tasks in PHP, including validation, case conversion, and inflection.

## Installation

You can install the package via Composer:

```bash
composer require syntatis/utils
```

## Usage

### Validator

This package includes several functions for validating values, such as checking if a value is an email, URL, or whether it is blank.

| Function     | Description                                            |
|--------------|--------------------------------------------------------|
| `is_blank`   | Checks if a value is blank or empty.                   |
| `is_email`   | Checks if a value is a valid email address.            |
| `is_url`     | Checks if a value is a valid URL.                      |
| `is_uuid`    | Checks if a value is a valid UUID.                     |
| `is_semver`  | Checks if a value is in valid SemVer format.           |
| `is_ip_address` | Checks if a value is a valid IPv4 or IPv6 address.  |
| `is_unique`  | Checks if all elements in a collection are unique.     |

#### Examples

```php
use function Syntatis\Utils\is_blank;
use function Syntatis\Utils\is_email;

// Check if a value is blank or empty
is_blank(''); // true
is_blank(' '); // true
is_blank('foo '); // false

// Check if a value is a valid email address
is_email('example@example.com'); // true
is_email('invalid-email'); // false
```

### Case Converter

The case converter functions allow you to convert strings to various cases, such as camel case, snake case, or kebab case.

| Function      | Description                                                |
|---------------|------------------------------------------------------------|
| `camelcased`  | Converts a string to camel case e.g. `foo_bar` to `fooBar`.|
| `snakecased`  | Converts a string to snake case e.g. `fooBar` to `foo_bar`.|
| `kebabcased`  | Converts a string to kebab case e.g. `fooBar` to `foo-bar`.|
| `pascalcased` | Converts a string to Pascal case e.g. `foo_bar` to `FooBar`.|
| `titlecased`  | Converts a string to title case e.g. `foo_bar` to `Foo Bar`.|
| `sentencecased` | Converts a string to sentence case e.g. `foo_bar` to `Foo bar`.|
| `lowercased`  | Converts a string to lower case e.g. `FooBar` to `foobar`.|
| `uppercased`  | Converts a string to upper case e.g. `fooBar` to `FOOBAR`.|
| `macrocased`  | Converts a string to macro case e.g. `fooBar` to `FOO_BAR`.|
| `cobolcased`  | Converts a string to Cobol case e.g. `fooBar` to `FOO-BAR`.|

#### Examples

```php
use function Syntatis\Utils\camelcased;

// Convert a string to camel case
camelcased('foo_bar'); // fooBar
```

### Inflector

The inflector functions perform common inflection tasks, such as pluralizing or singularizing words.

| Function     | Description                                |
|--------------|--------------------------------------------|
| `pluralize`  | Pluralizes a word e.g. `apple` to `apples`.|
| `singularize`| Singularizes a word e.g. `apples` to `apple`.|
| `slugify`    | Slugifies a string e.g. `Hello, World!` to `hello-world`.|

#### Examples

```php
use function Syntatis\Utils\pluralize;

// Pluralize a word
pluralize('apple'); // apples
```
