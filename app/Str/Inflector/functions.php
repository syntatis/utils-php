<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use Syntatis\Utils\Str\Inflector\Inflector;

/**
 * Convert a string (word) to its singular form.
 *
 * @phpstan-param non-empty-string $value
 */
function singularize(string $value): string
{
	return Inflector::instance()->singularize($value);
}

/**
 * Convert a string (word) to its plural form.
 *
 * @phpstan-param non-empty-string $value
 */
function pluralize(string $value): string
{
	return Inflector::instance()->pluralize($value);
}

/**
 * Convert a string to a URL friendly format.
 *
 * @phpstan-param non-empty-string $value
 */
function slugify(string $value): string
{
	return Inflector::instance()->urlize($value);
}
