<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use Syntatis\Utils\Support\Str\CaseConverter;

use function str_ends_with;
use function str_starts_with;
use function strlen;
use function strncmp;
use function substr_compare;

use const PHP_VERSION_ID;

final class Str
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
	 * Check if a string starts with a specific substring.
	 *
	 * @param string $haystack The string to search in e.g. HelloWorld.
	 * @param string $needle   The substring to search for e.g. Hello.
	 */
	public static function startsWith(string $haystack, string $needle): bool
	{
		if (PHP_VERSION_ID >= 80000) {
			return str_starts_with($haystack, $needle);
		}

		return strncmp($haystack, $needle, strlen($needle)) === 0;
	}

	/**
	 * Check if a string ends with a specific substring.
	 *
	 * @param string $haystack The string to search in e.g. HelloWorld.
	 * @param string $needle   The substring to search for e.g. World.
	 */
	public static function endsWith(string $haystack, string $needle): bool
	{
		if (PHP_VERSION_ID >= 80000) {
			return str_ends_with($haystack, $needle);
		}

		if ($needle === '' || $needle === $haystack) {
			return true;
		}

		if ($haystack === '') {
			return false;
		}

		$needleLength = strlen($needle);

		return $needleLength <= strlen($haystack) && substr_compare($haystack, $needle, -$needleLength) === 0;
	}

	/**
	 * Convert a value to "camelCase".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "hello_world".
	 *
	 * @return T The value in camel case e.g. "helloWorld".
	 */
	public static function toCamelCase(string $value): string
	{
		/**
		 * Cache for "camelCased" values.
		 *
		 * @var array<T,T> $camelCased
		 */
		static $camelCased = [];

		if (isset($camelCased[$value])) {
			return $camelCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toCamel();

		return $camelCased[$value] = $converted;
	}

	/**
	 * Convert a value to "kebab-case".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "helloWorld".
	 *
	 * @return T The value in kebab case e.g. "hello-world".
	 */
	public static function toKebabCase(string $value): string
	{
		/**
		 * Cache for "kebab-cased" value.
		 *
		 * @var array<T,T> $kebabCased
		 */
		static $kebabCased = [];

		if (isset($kebabCased[$value])) {
			return $kebabCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toKebab();

		return $kebabCased[$value] = $converted;
	}

	/**
	 * Convert a value to "snake case".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "helloWorld".
	 *
	 * @return T The value in snake case e.g. "hello_world".
	 */
	public static function toSnakeCase(string $value): string
	{
		/**
		 * Cache for "snake-cased" value.
		 *
		 * @var array<T,T> $snakeCased
		 */
		static $snakeCased = [];

		if (isset($snakeCased[$value])) {
			return $snakeCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toSnake();

		return $snakeCased[$value] = $converted;
	}

	/**
	 * Convert a value to "PascalCase".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "hello_world".
	 *
	 * @return T The value in pascal case e.g. "HelloWorld".
	 */
	public static function toPascalCase(string $value): string
	{
		/**
		 * Cache for "PascalCased" value.
		 *
		 * @var array<T,T> $pascalCased
		 */
		static $pascalCased = [];

		if (isset($pascalCased[$value])) {
			return $pascalCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toPascal();

		return $pascalCased[$value] = $converted;
	}

	/**
	 * Convert a value to "Title Case".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "hello_world".
	 *
	 * @return T The value in title case e.g. "Hello World".
	 */
	public static function toTitleCase(string $value): string
	{
		/**
		 * Cache for "Title Cased" values.
		 *
		 * @var array<T,T> $titleCased
		 */
		static $titleCased = [];

		if (isset($titleCased[$value])) {
			return $titleCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toTitle();

		return $titleCased[$value] = $converted;
	}

	/**
	 * Convert a value to "lowercase".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "Hello World".
	 *
	 * @return T The value in lower case e.g. "hello world".
	 */
	public static function toLowerCase(string $value): string
	{
		/**
		 * Cache for "lowercased" value.
		 *
		 * @var array<T,T> $lowerCased
		 */
		static $lowerCased = [];

		if (isset($lowerCased[$value])) {
			return $lowerCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toLower();

		return $lowerCased[$value] = $converted;
	}

	/**
	 * Convert a value to "UPPER CASE".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "Hello World".
	 *
	 * @return T The value in upper case e.g. "HELLO WORLD".
	 */
	public static function toUpperCase(string $value): string
	{
		/**
		 * Cache for "UPPER CASED" value.
		 *
		 * @var array<T,T> $upperCased
		 */
		static $upperCased = [];

		if (isset($upperCased[$value])) {
			return $upperCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toUpper();

		return $upperCased[$value] = $converted;
	}

	/**
	 * Convert a value to "MACRO_CASE".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "hello_world".
	 *
	 * @return T The value in macro case e.g. "HELLO_WORLD".
	 */
	public static function toMacroCase(string $value): string
	{
		/**
		 * Cache for "MACRO_CASED" value.
		 *
		 * @var array<T,T> $macroCased
		 */
		static $macroCased = [];

		if (isset($macroCased[$value])) {
			return $macroCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toMacro();

		return $macroCased[$value] = $converted;
	}

	/**
	 * Convert a value to "COBOL-CASE".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "hello_world".
	 *
	 * @return T The value in Cobol case e.g. "HELLO-WORLD".
	 */
	public static function toCobolCase(string $value): string
	{
		/**
		 * Cache for "COBOL-CASED" value.
		 *
		 * @var array<T,T> $cobolCased
		 */
		static $cobolCased = [];

		if (isset($cobolCased[$value])) {
			return $cobolCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toCobol();

		return $cobolCased[$value] = $converted;
	}

	/**
	 * Convert a value to "Sentence case".
	 *
	 * @template T of string
	 *
	 * @param T $value The value to convert e.g. "hello_world".
	 *
	 * @return T The value in sentence case e.g. "Hello world".
	 */
	public static function toSentenceCase(string $value): string
	{
		/**
		 * Cache for "Sentence cased" value.
		 *
		 * @var array<T,T> $sentenceCased
		 */
		static $sentenceCased = [];

		if (isset($sentenceCased[$value])) {
			return $sentenceCased[$value];
		}

		/** @var T $converted */
		$converted = CaseConverter::instance()
			->convert($value)
			->toSentence();

		return $sentenceCased[$value] = $converted;
	}
}
