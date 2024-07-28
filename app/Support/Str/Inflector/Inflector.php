<?php

declare(strict_types=1);

namespace Syntatis\Utils\Support\Str\Inflector;

use Doctrine\Inflector\Inflector as DoctrineInflector;
use Doctrine\Inflector\InflectorFactory;

/** @internal */
final class Inflector
{
	private static ?DoctrineInflector $instance = null;

	public static function instance(): DoctrineInflector
	{
		if (self::$instance === null) {
			self::$instance = InflectorFactory::create()->build();
		}

		return self::$instance;
	}
}
