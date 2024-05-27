<?php

declare(strict_types=1);

namespace Syntatis\Utils\Validator;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/** @internal */
final class Validator
{
	private static ?ValidatorInterface $instance = null;

	public static function instance(): ValidatorInterface
	{
		if (self::$instance instanceof ValidatorInterface) {
			return self::$instance;
		}

		self::$instance = Validation::createValidator();

		return self::$instance;
	}
}
