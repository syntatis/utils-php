<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Sequentially;
use Symfony\Component\Validator\Constraints\Unique;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Uuid;
use Syntatis\Utils\Validator\Validator;

use const PHP_VERSION_ID;

/**
 * Validate if the value is a valid email address according to RFC5322
 * {@link https://datatracker.ietf.org/doc/html/rfc5322}
 *
 * @param mixed $value
 *
 * @phpstan-assert-if-true non-empty-string $value
 */
function is_email($value): bool
{
	return Validator::instance()->validate(
		$value,
		new Sequentially(
			[
				new NotBlank(null, null, null, 'trim'),
				new Email(null, null, Email::VALIDATION_MODE_STRICT),
			],
		),
	)->count() <= 0;
}

/**
 * Validates that a value is a valid Universally unique identifier (UUID) per RFC 4122
 * {@link https://www.rfc-editor.org/rfc/rfc4122}
 *
 * @param mixed           $value
 * @param array<int>|null $versions
 *
 * @phpstan-param array<value-of<Uuid::ALL_VERSIONS>>|null $versions
 */
function is_uuid($value, ?array $versions = null): bool
{
	return Validator::instance()
		->validate(
			$value,
			new Uuid(
				null,
				null,
				$versions, // Versions.
				true, // Stricts.
			),
		)->count() <= 0;
}

/**
 * @param  mixed ...$value
 *
 * @phpstan-assert-if-true ''|array{}|false|null $value
 */
function is_blank(...$value): bool
{
	foreach ($value as $k => $v) {
		if (Validator::instance()->validate($v, new NotBlank(null, null, null, 'trim'))->count() >= 1) {
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
 */
function is_url($value, array $protocols = ['http', 'https']): bool
{
	return Validator::instance()->validate(
		$value,
		[
			new Sequentially(
				[
					new NotBlank(null, null, null, 'trim'),
					new Url(null, null, $protocols, null, 'trim'),
				],
			),
		],
	)->count() <= 0;
}

/**
 * @param mixed $value
 *
 * @phpstan-assert-if-true non-empty-string $value
 */
function is_semver($value): bool
{
	return Validator::instance()->validate(
		$value,
		new Regex(
			/** @see https://semver.org/#is-there-a-suggested-regular-expression-regex-to-check-a-semver-string */
			'/^v?(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)(?:-((?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*)(?:\.(?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*))*))?(?:\+([0-9a-zA-Z-]+(?:\.[0-9a-zA-Z-]+)*))?$/',
		),
	)->count() <= 0;
}

/**
 * Validate if the value is a valid IPv4 or IPv6 address.
 *
 * @param mixed $value
 *
 * @phpstan-assert-if-true non-empty-string $value
 */
function is_ip_address($value): bool
{
	return Validator::instance()->validate(
		$value,
		new Sequentially(
			[
				new NotBlank(null, null, null, 'trim'),
				new Ip([
					'normalizer' => 'trim',
					'version' => Ip::ALL,
				]),
			],
		),
	)->count() <= 0;
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
