<?php

declare(strict_types=1);

namespace Syntatis\Utils\Tests;

use Error;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Syntatis\Utils\Str;

class StrTest extends TestCase
{
	public function testInstance(): void
	{
		$this->expectException(Error::class);

		new Str();
	}

	/**
	 * @dataProvider dataCamelCased
	 * @testdox it can convert string to camelcase
	 */
	public function testCamelCased(string $value, string $expect): void
	{
		Str::toCamelCase($value);
		$this->assertEquals($expect, Str::toCamelCase($value));
	}

	/**
	 * @dataProvider dataKebabCased
	 * @testdox it can convert string to kebabcase
	 */
	public function testKebabCased(string $value, string $expect): void
	{
		Str::toKebabCase($value);
		$this->assertEquals($expect, Str::toKebabCase($value));
	}

	/**
	 * @dataProvider dataSnakeCased
	 * @testdox it can convert string to snakecase
	 */
	public function testSnakeCased(string $value, string $expect): void
	{
		Str::toSnakeCase($value);
		$this->assertEquals($expect, Str::toSnakeCase($value));
	}

	/**
	 * @dataProvider dataPascalCased
	 * @testdox it can convert string to pascalcase
	 */
	public function testPascalCased(string $value, string $expect): void
	{
		Str::toPascalCase($value);
		$this->assertEquals($expect, Str::toPascalCase($value));
	}

	/**
	 * @dataProvider dataTitleCased
	 * @testdox it can convert string to titlecase
	 */
	public function testTitleCased(string $value, string $expect): void
	{
		Str::toTitleCase($value);
		$this->assertEquals($expect, Str::toTitleCase($value));
	}

	/**
	 * @dataProvider dataLowerCased
	 * @testdox it can convert string to lowercase
	 */
	public function testLowerCased(string $value, string $expect): void
	{
		Str::toLowerCase($value);
		$this->assertEquals($expect, Str::toLowerCase($value));
	}

	/**
	 * @dataProvider dataUpperCased
	 * @testdox it can convert string to uppercase
	 */
	public function testUpperCased(string $value, string $expect): void
	{
		Str::toUpperCase($value);
		$this->assertEquals($expect, Str::toUpperCase($value));
	}

	/**
	 * @dataProvider dataMacroCased
	 * @testdox it can convert string to macrocase
	 */
	public function testMacroCased(string $value, string $expect): void
	{
		Str::toMacroCase($value);
		$this->assertEquals($expect, Str::toMacroCase($value));
	}

	/**
	 * @dataProvider dataCobolCased
	 * @testdox it can convert string to cobolcase
	 */
	public function testCobolCased(string $value, string $expect): void
	{
		Str::toCobolCase($value);
		$this->assertEquals($expect, Str::toCobolCase($value));
	}

	/**
	 * @dataProvider dataSentenceCased
	 * @testdox it can convert string to sentencecase
	 */
	public function testSentenceCased(string $value, string $expect): void
	{
		Str::toSentenceCase($value);
		$this->assertEquals($expect, Str::toSentenceCase($value));
	}

	public function dataPluralize(): iterable
	{
		yield ['test', 'tests'];
		yield ['child', 'children'];
		yield ['person', 'people'];
	}

	/**
	 * @dataProvider dataStartsWith
	 * @testdox it can check if a string starts with a given substring
	 */
	public function testStartsWith(string $value, string $needle, bool $expect): void
	{
		$this->assertSame($expect, Str::startsWith($value, $needle));
	}

	/**
	 * @dataProvider dataEndsWith
	 * @testdox it can check if a string ends with a given substring
	 */
	public function testEndsWith(string $value, string $needle, bool $expect): void
	{
		$this->assertSame($expect, Str::endsWith($value, $needle));
	}

	public function dataStartsWith(): iterable
	{
		return [
			['foo bar', 'foo', true],
			['foo bar', 'bar', false],
			['foo bar', 'foo bar', true],
			['foo bar', 'foo bar ', false],
			['foo bar', 'foo bar', true],
			['foo bar', 'foo bar ', false],
			['foo bar', 'foo bar', true],
			['foo bar', 'foo bar ', false],
			['', '', true],
			['', 'foo', false],
			['foo', '', true],
			['foo', 'foo', true],
			['foo', 'bar', false],
		];
	}

	public function dataEndsWith(): iterable
	{
		return [
			['foo bar', 'foo', false],
			['foo bar', 'bar', true],
			['foo bar', 'foo bar', true],
			['foo bar', 'foo bar ', false],
			['foo bar', 'foo bar', true],
			['foo bar', 'foo bar ', false],
			['foo bar', 'foo bar', true],
			['foo bar', 'foo bar ', false],
			['', '', true],
			['', 'foo', false],
			['foo', '', true],
			['foo', 'foo', true],
			['foo', 'bar', false],
		];
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

	public function dataSlugify(): iterable
	{
		yield [
			'Testing_Creating a -Slug from a random-string!@#',
			'testing-creating-a-slug-from-a-random-string',
		];

		yield [
			'Contesta el teléfono',
			'contesta-el-telefono',
		];

		yield [
			'den hund füttern',
			'den-hund-fuettern',
		];

		yield [
			'Jsem král na severu',
			'jsem-kral-na-severu',
		];

		yield [
			'test1::test2',
			'test1-test2',
		];

		yield [
			'test1$test2',
			'test1-test2',
		];

		yield [
			'TESTAb-test2',
			'testab-test2',
		];

		yield [
			'año',
			'ano',
		];
	}
}
