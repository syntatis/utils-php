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

## Usage

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

For examples:

```php
use function Syntatis\Utils\is_blank;
use function Syntatis\Utils\is_email;

// Whether a value is blank or empty.
is_blank(''); // `true`.
is_blank(' '); // `true`.
is_blank('foo '); // `false`.
```

For other functions and examples, please refer to the [Wiki](https://github.com/syntatis/utils-php/wiki).
