<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use Psr\Http\Message\UriInterface;

use function count;
use function filter_var;
use function implode;
use function is_array;
use function is_string;
use function preg_match;
use function sprintf;
use function trim;

use const FILTER_FLAG_EMAIL_UNICODE;
use const FILTER_VALIDATE_EMAIL;
use const FILTER_VALIDATE_IP;

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
		if (! is_string($value) || self::isBlank($value)) {
			return false;
		}

		return (bool) filter_var(trim($value), FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE);
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
		if (! is_string($value) || self::isBlank($value)) {
			return false;
		}

		return (bool) preg_match(
			'/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/',
			trim($value),
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

	/**
	 * Validates if the gvien value is a valid URL.
	 *
	 * @param mixed                                              $value
	 * @param array<array-key,"http"|"https"|"ftp"|"file"|"git"> $protocols
	 *
	 * @phpstan-assert-if-true non-empty-string $value
	 * @psalm-assert-if-true non-empty-string $value
	 */
	public static function isURL($value, array $protocols = ['http', 'https']): bool
	{
		if ($value instanceof UriInterface) {
			$value = (string) $value;
		}

		if (! is_string($value) || self::isBlank($value)) {
			return false;
		}

		$pattern = '~^
            (%s)://                                 # protocol
            (((?:[\_\.\pL\pN-]|%%[0-9A-Fa-f]{2})+:)?((?:[\_\.\pL\pN-]|%%[0-9A-Fa-f]{2})+)@)?  # basic auth
            (
                (?:
                    (?:xn--[a-z0-9-]++\.)*+xn--[a-z0-9-]++            # a domain name using punycode
                        |
                    (?:[\pL\pN\pS\pM\-\_]++\.)+[\pL\pN\pM]++          # a multi-level domain name
                        |
                    [a-z0-9\-\_]++                                    # a single-level domain name
                )\.?
                    |                                                 # or
                \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}                    # an IP address
                    |                                                 # or
                \[
                    (?:(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){6})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:::(?:(?:(?:[0-9a-f]{1,4})):){5})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){4})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,1}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){3})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,2}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){2})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,3}(?:(?:[0-9a-f]{1,4})))?::(?:(?:[0-9a-f]{1,4})):)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,4}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,5}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,6}(?:(?:[0-9a-f]{1,4})))?::))))
                \]  # an IPv6 address
            )
            (:[0-9]+)?                              # a port (optional)
            (?:/ (?:[\pL\pN\-._\~!$&\'()*+,;=:@]|%%[0-9A-Fa-f]{2})* )*          # a path
            (?:\? (?:[\pL\pN\-._\~!$&\'\[\]()*+,;=:@/?]|%%[0-9A-Fa-f]{2})* )?   # a query (optional)
            (?:\# (?:[\pL\pN\-._\~!$&\'()*+,;=:@/?]|%%[0-9A-Fa-f]{2})* )?       # a fragment (optional)
        $~ixu';
		$pattern = sprintf($pattern, implode('|', $protocols));

		return (bool) preg_match($pattern, trim($value));
	}

	/**
	 * @param mixed $value
	 *
	 * @phpstan-assert-if-true non-empty-string $value
	 * @psalm-assert-if-true non-empty-string $value
	 */
	public static function isSemVer($value): bool
	{
		if (! is_string($value) || self::isBlank($value)) {
			return false;
		}

		return (bool) preg_match(
			/** @see https://semver.org/#is-there-a-suggested-regular-expression-regex-to-check-a-semver-string */
			'/^v?(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)(?:-((?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*)(?:\.(?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*))*))?(?:\+([0-9a-zA-Z-]+(?:\.[0-9a-zA-Z-]+)*))?$/',
			trim($value),
		);
	}

	/**
	 * Validate if the value is a valid IPv4 or IPv6 address.
	 *
	 * @param mixed $value
	 *
	 * @phpstan-assert-if-true non-empty-string $value
	 * @psalm-assert-if-true non-empty-string $value
	 */
	public static function isIPAddress($value): bool
	{
		if (! is_string($value) || self::isBlank($value)) {
			return false;
		}

		return (bool) filter_var(trim($value), FILTER_VALIDATE_IP);
	}
}
