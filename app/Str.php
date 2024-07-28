<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use Syntatis\Utils\Support\Str\Inflector\Inflector;

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
	 * Prevent instantiation.
	 */
	final private function __construct()
	{
	}

	/**
	 * Convert a word to its singular form.
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
	 */
	public static function toPlural(string $word): string
	{
		if (isset(self::$pluralized[$word])) {
			return self::$pluralized[$word];
		}

		return self::$pluralized[$word] = Inflector::instance()->pluralize($word);
	}

	/**
	 * Convert a string to a URL friendly format.
	 */
	public static function toSlug(string $word): string
	{
		if (isset(self::$slugified[$word])) {
			return self::$slugified[$word];
		}

		return self::$slugified[$word] = Inflector::instance()->urlize($word);
	}
}
