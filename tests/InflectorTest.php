<?php

declare(strict_types=1);

namespace Syntatis\Utils\Tests;

use PHPUnit\Framework\TestCase;

use function Syntatis\Utils\pluralize;
use function Syntatis\Utils\singularize;
use function Syntatis\Utils\slugify;

class InflectorTest extends TestCase
{
	/** @dataProvider dataSingularize */
	public function testSingularize(string $value, string $expect): void
	{
		$this->assertSame(singularize($value), $expect);
	}

	public function dataSingularize(): iterable
	{
		yield ['tests', 'test'];
		yield ['children', 'child'];
		yield ['people', 'person'];
	}

	public function testPluralize(string $value, string $expect): void
	{
		$this->assertSame(pluralize($value), $expect);
	}

	public function dataPluralize(): iterable
	{
		yield ['test', 'tests'];
		yield ['child', 'children'];
		yield ['person', 'people'];
	}

	/**
	 * @dataProvider dataSlugify
	 * @testdox it can transform string to a url friendly format
	 */
	public function testSlugify(string $value, string $expect): void
	{
		$this->assertSame($expect, slugify($value));
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
