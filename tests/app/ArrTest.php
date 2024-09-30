<?php

declare(strict_types=1);

namespace Syntatis\Utils\Tests;

use Error;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Syntatis\Utils\Arr;

class ArrTest extends TestCase
{
	public function testInstantiate(): void
	{
		$this->expectException(Error::class);

		new Arr();
	}

	/**
	 * @dataProvider dataIsUnique
	 * @testdox it can validate unique collection
	 *
	 * @param mixed $value
	 */
	public function testIsUnique($value): void
	{
		$this->assertTrue(Arr::isUnique($value));
	}

	/**
	 * @dataProvider dataIsNotUnique
	 * @testdox it can validate non-unique collection
	 *
	 * @param mixed $value
	 */
	public function testIsNotUnique($value): void
	{
		$this->assertFalse(Arr::isUnique($value));
	}

	/**
	 * @dataProvider dataIsUniqueOptionFields
	 * @testdox it can validate unique collection
	 *
	 * @param mixed                $value
	 * @param string|array<string> $fields The list of fields to check uniqueness.
	 */
	public function testIsUniqueOptionFields($value, $fields = []): void
	{
		$this->assertTrue(Arr::isUnique($value, $fields));
	}

	/**
	 * @dataProvider dataIsNotUniqueOptionFields
	 * @testdox it can validate unique collection
	 *
	 * @param mixed                $value
	 * @param string|array<string> $fields The list of fields to check uniqueness.
	 */
	public function testIsNotUniqueOptionFields($value, $fields = []): void
	{
		$this->assertFalse(Arr::isUnique($value, $fields));
	}

	public function testIsUniqueInvalidFields(): void
	{
		$this->expectException(InvalidArgumentException::class);

		Arr::isUnique(['a' => [1], 'b' => [2], 'c' => [3]], [2]);
	}

	/**
	 * @dataProvider dataIsList
	 * @testdox it can validate list
	 *
	 * @param mixed $value
	 */
	public function testIsList($value): void
	{
		$this->assertTrue(Arr::isList($value));
	}

	/**
	 * @dataProvider dataIsNotList
	 * @testdox it can validate non-list
	 *
	 * @param mixed $value
	 */
	public function testIsNotList($value): void
	{
		$this->assertFalse(Arr::isList($value));
	}

	public static function dataIsUnique(): array
	{
		return [
			'sequential' => [[1, 2, 3]],
			'associative' => [['a' => 1, 'b' => 2, 'c' => 3]],
			'multidimensional' => [['a' => 1, 'b' => [1, 2], 'c' => ['a' => 1, 'b' => 2]]],
		];
	}

	public static function dataIsUniqueOptionFields(): array
	{
		return [
			[
				[
					[
						'label' => 'foo',
						'latitude' => '3',
						'longitude' => '2',
					],
					[
						'label' => 'bar',
						'latitude' => '3',
						'longitude' => '4',
					],
				],
				['latitude', 'longitude'],
			],
		];
	}

	public static function dataIsNotUnique(): array
	{
		return [
			'empty' => [[]],
			'sequential' => [[1, 2, 2]], // index 1 and 2 are not unique.
			'associative' => [['a' => 1, 'b' => 2, 'c' => 2]], // b and c are not unique.
			'multidimensional' => [['a' => 1, 'b' => [1, 2], 'c' => [1, 2]]], // b and c are not unique.
		];
	}

	public static function dataIsNotUniqueOptionFields(): array
	{
		return [
			[
				[
					[
						'label' => 'foo',
						'latitude' => '3',
						'longitude' => '2',
					],
					[
						'label' => 'bar',
						'latitude' => '3',
						'longitude' => '4',
					],
				],
				'latitude',
			],
		];
	}

	public static function dataIsList(): array
	{
		return [
			'empty' => [[]],
			'sequential' => [[1, 2, 3]],
			'nested' => [[1, [2, 3], 4]],
		];
	}

	public static function dataIsNotList(): array
	{
		return [
			'associative' => [['a' => 1, 'b' => 2, 'c' => 3]],
			'mixed' => [[1, 'a' => 2, 3]],
		];
	}
}
