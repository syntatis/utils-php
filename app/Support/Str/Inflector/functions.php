<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use function trigger_deprecation;

/**
 * Convert a string (word) to its singular form.
 */
function singularize(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toSingular',
	);

	return Str::toSingular($value);
}

/**
 * Convert a string (word) to its plural form.
 */
function pluralize(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toPlural',
	);

	return Str::toPlural($value);
}

/**
 * Convert a string to a URL friendly format.
 */
function slugify(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toSlug',
	);

	return Str::toSlug($value);
}
