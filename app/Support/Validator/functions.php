<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Sequentially;
use Symfony\Component\Validator\Constraints\Unique;
use Syntatis\Utils\Support\Validator\Validator;

use function trigger_deprecation;

use const PHP_VERSION_ID;

/**
 * Validate if the value is a valid email address.
 *
 * @param mixed $value
 *
 * @phpstan-assert-if-true non-empty-string $value
 * @psalm-assert-if-true non-empty-string $value
 */
function is_email($value): bool
{
	trigger_deprecation(
		'syntatis/utils',
		'1.4',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Val::class . '::isEmail',
	);

	return Val::isEmail($value);
}

/**
 * Validates that a value is a valid Universally unique identifier (UUID) per RFC 4122
 * {@link https://www.rfc-editor.org/rfc/rfc4122}
 *
 * @param mixed           $value
 * @param array<int>|null $versions
 */
function is_uuid($value, ?array $versions = null): bool
{
	trigger_deprecation(
		'syntatis/utils',
		'1.4',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Val::class . '::isUUID',
	);

	return Val::isUUID($value);
}

/**
 * @param  mixed ...$value
 *
 * @phpstan-assert-if-true ''|array{}|false|null $value
 */
function is_blank(...$value): bool
{
	trigger_deprecation(
		'syntatis/utils',
		'1.4',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Val::class . '::isBlank',
	);

	foreach ($value as $k => $v) {
		if (Val::isBlank($v)) {
			continue;
		}

		return false;
	}

	return true;
}

/**
 * @param mixed                                               $value
 * @param array<array-key, "http"|"https"|"ftp"|"file"|"git"> $protocols
 *
 * @phpstan-assert-if-true non-empty-string $value
 * @psalm-assert-if-true non-empty-string $value
 */
function is_url($value, array $protocols = ['http', 'https']): bool
{
	trigger_deprecation(
		'syntatis/utils',
		'1.4',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Val::class . '::isURL',
	);

	return Val::isURL($value);
}

/**
 * @param mixed $value
 *
 * @phpstan-assert-if-true non-empty-string $value
 * @psalm-assert-if-true non-empty-string $value
 */
function is_semver($value): bool
{
	trigger_deprecation(
		'syntatis/utils',
		'1.4',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Val::class . '::isSemVer',
	);

	return Val::isSemVer($value);
}

/**
 * Validate if the value is a valid IPv4 or IPv6 address.
 *
 * @param mixed $value
 *
 * @phpstan-assert-if-true non-empty-string $value
 * @psalm-assert-if-true non-empty-string $value
 */
function is_ip_address($value): bool
{
	trigger_deprecation(
		'syntatis/utils',
		'1.4',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Val::class . '::isIPAddress',
	);

	return Val::isIPAddress($value);
}

/**
 * Validates that all elements in the provided collection are unique, employing
 * strict comparison by default (treating '7' and 7 as distinct elements).
 *
 * @param mixed                $value
 * @param string|array<string> $fields Specifies the key or keys in a collection
 *                                     to be examined for uniqueness.
 *                                     Required PHP 8.1 or higher.
 *
 * @phpstan-assert-if-true non-empty-array $value
 * @psalm-assert-if-true non-empty-array $value
 */
function is_unique($value, $fields = []): bool
{
	$notBlank = new NotBlank(null, null, null);

	if (PHP_VERSION_ID < 80100) {
		return Validator::instance()->validate(
			$value,
			new Sequentially([
				$notBlank,
				new Unique(),
			]),
		)->count() <= 0;
	}

	return Validator::instance()->validate(
		$value,
		new Sequentially([
			$notBlank,
			new Unique(['fields' => $fields]),
		]),
	)->count() <= 0;
}
