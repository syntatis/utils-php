<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use InvalidArgumentException;

use function array_key_exists;
use function array_values;
use function in_array;
use function is_array;
use function is_string;

final class Arr
{
	/**
	 * Prevent instantiation.
	 *
	 * @codeCoverageIgnore
	 */
	final private function __construct()
	{
	}

	/**
	 * Validates that the provided array is a list (i.e. it has only numeric keys
	 * starting from 0 and increasing by 1 for each element).
	 *
	 * @param array<mixed> $array
	 */
	public static function isList(array $array): bool
	{
		if ($array === [] || $array === array_values($array)) {
			return true;
		}

		$nextKey = -1;

		foreach ($array as $k => $v) {
			if ($k !== ++$nextKey) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Validates that all elements in the provided array are unique, employing
	 * strict comparison by default (treating '7' and 7 as distinct elements).
	 *
	 * @param array<mixed>         $value
	 * @param string|array<string> $fields Specifies the key or keys in a collection
	 *                                     to be examined for uniqueness.
	 *
	 * @phpstan-assert-if-true non-empty-array $value
	 * @psalm-assert-if-true non-empty-array $value
	 */
	public static function isUnique(array $value, $fields = []): bool
	{
		if (Val::isBlank($value)) {
			return false;
		}

		$collection = [];

		if (is_string($fields)) {
			$fields = [$fields];
		}

		foreach ($value as $key => $element) {
			if ($fields !== [] && is_array($element)) {
				$element = self::reduceElementKeys($fields, $element);

				if ($element === []) {
					continue;
				}
			}

			if (in_array($element, $collection, true)) {
				return false;
			}

			$collection[] = $element;
		}

		return true;
	}

	/**
	 * @param array<mixed>         $fields
	 * @param array<string, mixed> $element
	 *
	 * @return array<string, mixed>
	 */
	private static function reduceElementKeys(array $fields, array $element): array
	{
		$output = [];
		foreach ($fields as $field) {
			if (! is_string($field)) {
				throw new InvalidArgumentException('The field name must be a string.');
			}

			if (! array_key_exists($field, $element)) {
				continue;
			}

			$output[$field] = $element[$field];
		}

		return $output;
	}
}
