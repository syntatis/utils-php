<?php

declare(strict_types=1);

namespace Syntatis\Utils\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

use function Syntatis\Utils\camelcased;
use function Syntatis\Utils\cobolcased;
use function Syntatis\Utils\kebabcased;
use function Syntatis\Utils\lowercased;
use function Syntatis\Utils\macrocased;
use function Syntatis\Utils\pascalcased;
use function Syntatis\Utils\sentencecased;
use function Syntatis\Utils\snakecased;
use function Syntatis\Utils\titlecased;
use function Syntatis\Utils\uppercased;

class CaseConverterTest extends TestCase
{
	/**
	 * @dataProvider dataCamelCased
	 * @testdox it can convert string to camelcase
	 */
	public function testCamelCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, camelcased($value));
	}

	/**
	 * @dataProvider dataKebabCased
	 * @testdox it can convert string to camelcase
	 */
	public function testKebabCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, kebabcased($value));
	}

	/**
	 * @dataProvider dataSnakeCased
	 * @testdox it can convert string to snakecase
	 */
	public function testSnakeCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, snakecased($value));
	}

	/**
	 * @dataProvider dataPascalCased
	 * @testdox it can convert string to pascalcase
	 */
	public function testPascalCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, pascalcased($value));
	}

	/**
	 * @dataProvider dataTitleCased
	 * @testdox it can convert string to titlecase
	 */
	public function testTitleCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, titlecased($value));
	}

	/**
	 * @dataProvider dataLowerCased
	 * @testdox it can convert string to lowercase
	 */
	public function testLowerCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, lowercased($value));
	}

	/**
	 * @dataProvider dataUpperCased
	 * @testdox it can convert string to uppercase
	 */
	public function testUpperCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, uppercased($value));
	}

	/**
	 * @dataProvider dataMacroCased
	 * @testdox it can convert string to macrocase
	 */
	public function testMacroCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, macrocased($value));
	}

	/**
	 * @dataProvider dataCobolCased
	 * @testdox it can convert string to cobolcase
	 */
	public function testCobolCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, cobolcased($value));
	}

	/**
	 * @dataProvider dataSentenceCased
	 * @testdox it can convert string to sentencecase
	 */
	public function testSentenceCased(string $value, string $expect): void
	{
		$this->assertEquals($expect, sentencecased($value));
	}

	public function dataCamelCased(): iterable
	{
		return [['foo_bar', 'fooBar'], ['foo-bar', 'fooBar'], ['foo bar', 'fooBar'], ['fooBar', 'fooBar'], ['FooBar', 'fooBar']];
	}

	public function dataKebabCased(): iterable
	{
		return [['foo_bar', 'foo-bar'], ['foo-bar', 'foo-bar'], ['foo bar', 'foo-bar'], ['fooBar', 'foo-bar'], ['FooBar', 'foo-bar']];
	}

	public function dataSnakeCased(): iterable
	{
		return [['foo_bar', 'foo_bar'], ['foo-bar', 'foo_bar'], ['foo bar', 'foo_bar'], ['fooBar', 'foo_bar'], ['FooBar', 'foo_bar']];
	}

	public function dataPascalCased(): iterable
	{
		return [['foo_bar', 'FooBar'], ['foo-bar', 'FooBar'], ['foo bar', 'FooBar'], ['fooBar', 'FooBar'], ['FooBar', 'FooBar']];
	}

	public function dataTitleCased(): iterable
	{
		return [['foo_bar', 'Foo Bar'], ['foo-bar', 'Foo Bar'], ['foo bar', 'Foo Bar'], ['fooBar', 'Foo Bar'], ['FooBar', 'Foo Bar']];
	}

	public function dataLowerCased(): iterable
	{
		return [['foo_bar', 'foo bar'], ['foo-bar', 'foo bar'], ['foo bar', 'foo bar'], ['fooBar', 'foo bar'], ['FooBar', 'foo bar']];
	}

	public function dataUpperCased(): iterable
	{
		return [['foo_bar', 'FOO BAR'], ['foo-bar', 'FOO BAR'], ['foo bar', 'FOO BAR'], ['fooBar', 'FOO BAR'], ['FooBar', 'FOO BAR']];
	}

	public function dataMacroCased(): iterable
	{
		return [['foo_bar', 'FOO_BAR'], ['foo-bar', 'FOO_BAR'], ['foo bar', 'FOO_BAR'], ['fooBar', 'FOO_BAR'], ['FooBar', 'FOO_BAR']];
	}

	public function dataCobolCased(): iterable
	{
		return [['foo_bar', 'FOO-BAR'], ['foo-bar', 'FOO-BAR'], ['foo bar', 'FOO-BAR'], ['fooBar', 'FOO-BAR'], ['FooBar', 'FOO-BAR']];
	}

	public function dataSentenceCased(): iterable
	{
		return [['foo_bar', 'Foo bar'], ['foo-bar', 'Foo bar'], ['foo bar', 'Foo bar'], ['fooBar', 'Foo bar'], ['FooBar', 'Foo bar']];
	}
}
