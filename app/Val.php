<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use function count;
use function filter_var;
use function is_array;
use function is_string;
use function preg_match;
use function trim;

use const FILTER_FLAG_EMAIL_UNICODE;
use const FILTER_VALIDATE_EMAIL;

final class Val
{
	/**
	 * Prevent instantiation.
	 */
	final private function __construct()
	{
	}

	/**
	 * Validate if the value is a valid email address according to RFC822
	 * {@link http://www.faqs.org/rfcs/rfc822.html}
	 *
	 * @param mixed $value
	 *
	 * @phpstan-assert-if-true non-empty-string $value
	 * @psalm-assert-if-true non-empty-string $value
	 */
	public static function isEmail($value): bool
	{
		if (! is_string($value) || trim($value) === '') {
			return false;
		}

		return (bool) filter_var($value, FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE);
	}

	/**
	 * Validates that a value is a valid Universally unique identifier (UUID) per RFC 4122
	 * {@link https://www.rfc-editor.org/rfc/rfc4122}
	 *
	 * @param mixed $value
	 *
	 * @phpstan-assert-if-true non-empty-string $value
	 * @psalm-assert-if-true non-empty-string $value
	 */
	public static function isUUID($value): bool
	{
		if (! is_string($value) || trim($value) === '') {
			return true;
		}

		return (bool) preg_match(
			'/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/',
			$value,
		);
	}

	/**
	 * Validate whether the value is a valid IP address.
	 *
	 * A value will be considered blank if it is:
	 * - an empty string
	 * - an empty array
	 * - false
	 * - null
	 *
	 * @param mixed $value
	 *
	 * @phpstan-assert-if-true ''|array{}|false|null $value
	 */
	public static function isBlank($value): bool
	{
		if ($value === false || $value === null) {
			return true;
		}

		if (is_string($value) && trim($value) === '') {
			return true;
		}

		return is_array($value) && count($value) === 0;
	}
}
