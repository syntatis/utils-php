# 🧰 utils-php

![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/syntatis/utils/php?color=%237A86B8) [![php](https://github.com/syntatis/utils-php/actions/workflows/php.yml/badge.svg)](https://github.com/syntatis/utils-php/actions/workflows/php.yml) [![codecov](https://codecov.io/gh/syntatis/utils-php/graph/badge.svg?token=QH387BY1PK)](https://codecov.io/gh/syntatis/utils-php) ![Packagist Downloads](https://img.shields.io/packagist/dt/syntatis/utils)

The `syntatis/utils` package provides a variety of utility functions to simplify common tasks in PHP, including validation, case conversion, and inflection.

## Installation

You can install the package via Composer:

```bash
composer require syntatis/utils
```

## Usage

### Validator

This package includes several functions for validating values, such as checking if a value is an email, URL, or whether it is blank.

| Function           | Description                                            |
|--------------------|--------------------------------------------------------|
| `Val::isBlank`     | Checks if a value is blank or empty.                   |
| `Val::isEmail`     | Checks if a value is a valid email address.            |
| `Val::isURL`       | Checks if a value is a valid URL.                      |
| `Val::isUUID`      | Checks if a value is a valid UUID.                     |
| `Val::isSemVer`    | Checks if a value is in valid SemVer format.           |
| `Val::isIPAddress` | Checks if a value is a valid IPv4 or IPv6 address.     |
| `Val::isUnique`    | Checks if all elements in a collection are unique.     |

#### Examples

```php
use function Syntatis\Utils\Val;

// Check if a value is blank or empty
Val::isBlank(''); // true
Val::isBlank(' '); // true
Val::isBlank('foo '); // false

// Check if a value is a valid email address
Val::isEmail('example@example.com'); // true
Val::isEmail('invalid-email'); // false
```

### Strings

This package includes several functions to handle strings, such as converting a string to camel case, makes a word plural, or checking if a string starts with a specific substring.

| Function      | Description                                                            |
|---------------|------------------------------------------------------------------------|
| `Str::toCamelCase`    | Converts a string to camel case e.g. `foo_bar` to `fooBar`.    |
| `Str::toSnakeCase`    | Converts a string to snake case e.g. `fooBar` to `foo_bar`.    |
| `Str::toKebabCase`    | Converts a string to kebab case e.g. `fooBar` to `foo-bar`.    |
| `Str::toPascalCase`   | Converts a string to Pascal case e.g. `foo_bar` to `FooBar`.   |
| `Str::toTitleCase`    | Converts a string to title case e.g. `foo_bar` to `Foo Bar`.   |
| `Str::toSentenceCase` | Converts a string to sentence case e.g. `foo_bar` to `Foo bar`.|
| `Str::toLowerCase`    | Converts a string to lower case e.g. `FooBar` to `foobar`.     |
| `Str::toUpperCase`    | Converts a string to upper case e.g. `fooBar` to `FOOBAR`.     |
| `Str::toMacroCase`    | Converts a string to macro case e.g. `fooBar` to `FOO_BAR`.    |
| `Str::toCobolCase`    | Converts a string to Cobol case e.g. `fooBar` to `FOO-BAR`.    |
| `Str::startsWith`     | Check if a string starts with a specific substring.            |
| `Str::endsWith`       | Check if a string ends with a specific substring.              |

#### Examples

```php
use function Syntatis\Utils\Str;

// Convert a string to camel case
Str::toCamelCase('foo_bar'); // fooBar

// Check if a string starts with a specific substring
Str::startsWith('Hello, World!', 'Hello'); // true
```
