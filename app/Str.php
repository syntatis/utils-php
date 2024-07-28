<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use Syntatis\Utils\Support\Str\CaseConverter;
use Syntatis\Utils\Support\Str\Inflector;

final class Str
{
	/**
	 * Cache for singularized words.
	 *
	 * @var array<string,string>
	 */
	private static array $singularized = [];

	/**
	 * Cache for pluralized words.
	 *
	 * @var array<string,string>
	 */
	private static array $pluralized = [];

	/**
	 * Cache for slugified words.
	 *
	 * @var array<string,string>
	 */
	private static array $slugified = [];

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
	 * Cache for snake-cased words.
	 *
	 * @var array<string,string>
	 */
	private static array $snakeCased = [];

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
	 * Convert a word to its singular form.
	 *
	 * @param string $word The word to convert e.g. "dogs".
	 * @return string The singular form of the word e.g. "dog".
	 */
	public static function toSingular(string $word): string
	{
		if (isset(self::$singularized[$word])) {
			return self::$singularized[$word];
		}

		return self::$singularized[$word] = Inflector::instance()->singularize($word);
	}

	/**
	 * Convert a word to its plural form.
	 *
	 * @param string $word The word to convert e.g. "dog".
	 * @return string The plural form of the word e.g. "dogs".
	 */
	public static function toPlural(string $word): string
	{
		if (isset(self::$pluralized[$word])) {
			return self::$pluralized[$word];
		}

		return self::$pluralized[$word] = Inflector::instance()->pluralize($word);
	}

	/**
	 * Convert a word to a URL friendly format.
	 *
	 * @param string $word The word to convert e.g. "Hello World".
	 * @return string The URL friendly format of the word e.g. "hello-world".
	 */
	public static function toSlug(string $word): string
	{
		if (isset(self::$slugified[$word])) {
			return self::$slugified[$word];
		}

		return self::$slugified[$word] = Inflector::instance()->urlize($word);
	}

	/**
	 * Convert a word to camel case.
	 *
	 * @param string $word The word to convert e.g. "hello_world".
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
	 * @param string $word The word to convert e.g. "helloWorld".
	 * @return string The word in snake case e.g. "hello_world".
	 */
	public static function toSnakeCase(string $word): string
	{
		if (isset(self::$snakeCased[$word])) {
			return self::$snakeCased[$word];
		}

		return self::$snakeCased[$word] = CaseConverter::instance()->convert($word)->toSnake();
	}

	/**
	 * Convert a word to pascal case.
	 *
	 * @param string $word The word to convert e.g. "hello_world".
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
