<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use function trigger_deprecation;

/**
 * Convert a string to "camelCase" format.
 *
 * @deprecated 1.3, use `Str::toCamelCase` instead.
 */
function camelcased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toCamelCase',
	);

	return Str::toCamelCase($value);
}

/**
 * Convert a string to "kebab-case" format.
 *
 * @deprecated 1.3, use `Str::toKebabCase` instead.
 */
function kebabcased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toKebabCase',
	);

	return Str::toKebabCase($value);
}

/**
 * Convert a string to "snake_case" format.
 *
 * @deprecated 1.3, use `Str::toSnakeCase` instead.
 */
function snakecased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toSnakeCase',
	);

	return Str::toSnakeCase($value);
}

/**
 * Convert a string to "PascalCase" format.
 *
 * @deprecated 1.3, use `Str::toPascalCase` instead.
 */
function pascalcased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toPascalCase',
	);

	return Str::toPascalCase($value);
}

/**
 * Convert a string to "Title case" format.
 *
 * @deprecated 1.3, use `Str::toTitleCase` instead.
 */
function titlecased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toTitleCase',
	);

	return Str::toTitleCase($value);
}

/**
 * Convert a string to "lowercased" format.
 *
 * @deprecated 1.3, use `Str::toLowercase` instead.
 */
function lowercased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toLowerCase',
	);

	return Str::toLowerCase($value);
}

/**
 * Convert a string to "UPPERCASE" format.
 *
 * @deprecated 1.3, use `Str::toUpperCase` instead.
 */
function uppercased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toLowerCase',
	);

	return Str::toUpperCase($value);
}

/**
 * Convert a string to "MACRO_CASED" format.
 *
 * @deprecated 1.3, use `Str::toMacroCase` instead.
 */
function macrocased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toMacroCase',
	);

	return Str::toMacroCase($value);
}

/**
 * Convert a string to "COBOL-CASED" format.
 *
 * @deprecated 1.3, use `Str::toCobolCase` instead.
 */
function cobolcased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toCobolCase',
	);

	return Str::toCobolCase($value);
}

/**
 * Convert a string to "Sentence case" format.
 *
 * @deprecated 1.3, use `Str::toSentenceCase` instead.
 */
function sentencecased(string $value): string
{
	trigger_deprecation(
		'syntatis/utils',
		'1.3',
		'The "%s" function is deprecated, use "%s" instead.',
		__FUNCTION__,
		Str::class . '::toSentenceCase',
	);

	return Str::toSentenceCase($value);
}
