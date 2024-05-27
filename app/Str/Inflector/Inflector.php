<?php

declare(strict_types=1);

namespace Syntatis\Utils\Str\Inflector;

use Doctrine\Inflector\Inflector as DoctrineInflector;
use Doctrine\Inflector\InflectorFactory;

class Inflector
{
	private static ?DoctrineInflector $inflector = null;

	public static function instance(): DoctrineInflector
	{
		if (self::$inflector === null) {
			self::$inflector = InflectorFactory::create()->build();
		}

		return self::$inflector;
	}
}
