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
	 * Cache for camel-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $camelCased = [];

	/**
	 * Cache for kebab-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $kebabCased = [];

	/**
	 * Cache for pascal-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $pascalCased = [];

	/**
	 * Cache for title-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $titleCased = [];

	/**
	 * Cache for lower-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $lowerCased = [];

	/**
	 * Cache for upper-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $upperCased = [];

	/**
	 * Cache for macro-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $macroCased = [];

	/**
	 * Cache for Cobol-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $cobolCased = [];

	/**
	 * Cache for sentence-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $sentenceCased = [];

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
	 * Convert a word to camel case.
	 *
	 * @param string $word The word to convert e.g. "hello_world".
	 *
	 * @return string The word in camel case e.g. "helloWorld".
	 */
	public static function toCamelCase(string $word): string
	{
		if (isset(self::$camelCased[$word])) {
			return self::$camelCased[$word];
		}

		return self::$camelCased[$word] = CaseConverter::instance()->convert($word)->toCamel();
	}

	/**
	 * Convert a word to kebab case.
	 *
	 * @param string $word The word to convert e.g. "helloWorld".
	 *
	 * @return string The word in kebab case e.g. "hello-world".
	 */
	public static function toKebabCase(string $word): string
	{
		if (isset(self::$kebabCased[$word])) {
			return self::$kebabCased[$word];
		}

		return self::$kebabCased[$word] = CaseConverter::instance()->convert($word)->toKebab();
	}

	/**
	 * Convert a word to snake case.
	 *
	 * @template T of string
	 *
	 * @param string $word The word to convert e.g. "helloWorld".
	 * @phpstan-param T $word
	 * @psalm-param T $word
	 *
	 * @return string The word in snake case e.g. "hello_world".
	 * @phpstan-return T
	 * @psalm-return T
	 */
	public static function toSnakeCase(string $word): string
	{
		/**
		 * Cache for snake-cased words.
		 *
		 * @phpstan-var array<T,T> $snakeCased
		 */
		static $snakeCased = [];

		if (isset($snakeCased[$word])) {
			return $snakeCased[$word];
		}

		/** @phpstan-var T $converted */
		$converted = CaseConverter::instance()
			->convert($word)
			->toSnake();

		return $snakeCased[$word] = $converted;
	}

	/**
	 * Convert a word to pascal case.
	 *
	 * @param string $word The word to convert e.g. "hello_world".
	 *
	 * @return string The word in pascal case e.g. "HelloWorld".
	 */
	public static function toPascalCase(string $word): string
	{
		if (isset(self::$pascalCased[$word])) {
			return self::$pascalCased[$word];
		}

		return self::$pascalCased[$word] = CaseConverter::instance()->convert($word)->toPascal();
	}

	/**
	 * Convert a word to title case.
	 *
	 * @param string $word The word to convert e.g. "hello_world".
	 *
	 * @return string The word in title case e.g. "Hello World".
	 */
	public static function toTitleCase(string $word): string
	{
		if (isset(self::$titleCased[$word])) {
			return self::$titleCased[$word];
		}

		return self::$titleCased[$word] = CaseConverter::instance()->convert($word)->toTitle();
	}

	/**
	 * Convert a word to lower case.
	 *
	 * @param string $word The word to convert e.g. "Hello World".
	 *
	 * @return string The word in lower case e.g. "hello world".
	 */
	public static function toLowerCase(string $word): string
	{
		if (isset(self::$lowerCased[$word])) {
			return self::$lowerCased[$word];
		}

		return self::$lowerCased[$word] = CaseConverter::instance()->convert($word)->toLower();
	}

	/**
	 * Convert a word to upper case.
	 *
	 * @param string $word The word to convert e.g. "Hello World".
	 *
	 * @return string The word in upper case e.g. "HELLO WORLD".
	 */
	public static function toUpperCase(string $word): string
	{
		if (isset(self::$upperCased[$word])) {
			return self::$upperCased[$word];
		}

		return self::$upperCased[$word] = CaseConverter::instance()->convert($word)->toUpper();
	}

	/**
	 * Convert a word to macro case.
	 *
	 * @param string $word The word to convert e.g. "hello_world".
	 *
	 * @return string The word in macro case e.g. "HELLO_WORLD".
	 */
	public static function toMacroCase(string $word): string
	{
		if (isset(self::$macroCased[$word])) {
			return self::$macroCased[$word];
		}

		return self::$macroCased[$word] = CaseConverter::instance()->convert($word)->toMacro();
	}

	/**
	 * Convert a word to Cobol case.
	 *
	 * @param string $word The word to convert e.g. "hello_world".
	 *
	 * @return string The word in Cobol case e.g. "HELLO-WORLD".
	 */
	public static function toCobolCase(string $word): string
	{
		if (isset(self::$cobolCased[$word])) {
			return self::$cobolCased[$word];
		}

		return self::$cobolCased[$word] = CaseConverter::instance()->convert($word)->toCobol();
	}

	/**
	 * Convert a word to sentence case.
	 *
	 * @param string $word The word to convert e.g. "hello_world".
	 *
	 * @return string The word in sentence case e.g. "Hello world".
	 */
	public static function toSentenceCase(string $word): string
	{
		if (isset(self::$sentenceCased[$word])) {
			return self::$sentenceCased[$word];
		}

		return self::$sentenceCased[$word] = CaseConverter::instance()->convert($word)->toSentence();
	}
}
