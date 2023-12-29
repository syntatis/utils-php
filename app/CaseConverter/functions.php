<?php

declare(strict_types=1);

namespace Syntatis\Utils;

use Syntatis\Utils\CaseConverter\CaseConverter;

/**
 * Convert a string to "camelCase" format.
 */
function camelcased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toCamel();
}

/**
 * Convert a string to "kebab-case" format.
 */
function kebabcased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toKebab();
}

/**
 * Convert a string to "snake_case" format.
 */
function snakecased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toSnake();
}

/**
 * Convert a string to "PascalCase" format.
 */
function pascalcased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toPascal();
}

/**
 * Convert a string to "Title case" format.
 */
function titlecased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toTitle();
}

/**
 * Convert a string to "lowercased" format.
 */
function lowercased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toLower();
}

/**
 * Convert a string to "UPPERCASE" format.
 */
function uppercased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toUpper();
}

/**
 * Convert a string to "MACRO_CASED" format.
 */
function macrocased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toMacro();
}

/**
 * Convert a string to "COBOL-CASED" format.
 */
function cobolcased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toCobol();
}

/**
 * Convert a string to "Sentence case" format.
 */
function sentencecased(string $value): string
{
	return CaseConverter::instance()->convert($value)->toSentence();
}
