<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use Syntatis\Utils\Str\Inflector\Inflector;

/**
 * Convert a string (word) to its singular form.
 */
function singularize(string $value): string
{
	return Inflector::instance()->singularize($value);
}

/**
 * Convert a string (word) to its plural form.
 */
function pluralize(string $value): string
{
	return Inflector::instance()->pluralize($value);
}

/**
 * Convert a string to a URL friendly format.
 */
function slugify(string $value): string
{
	return Inflector::instance()->urlize($value);
}
