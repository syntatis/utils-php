<?php

declare(strict_types=1);

namespace Syntatis\Utils\Str\CaseConverter;

use Jawira\CaseConverter\CaseConverter as CaseConverterFactory;

class CaseConverter
{
	private static ?CaseConverterFactory $instance = null;

	public static function instance(): CaseConverterFactory
	{
		if (self::$instance instanceof CaseConverterFactory) {
			return self::$instance;
		}

		self::$instance = new CaseConverterFactory();

		return self::$instance;
	}
}
