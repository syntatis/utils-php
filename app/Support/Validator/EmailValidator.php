<?php

declare(strict_types=1);

namespace Syntatis\Utils\Support\Validator;

use Egulias\EmailValidator\EmailValidator as UpstreamEmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

/** @internal */
final class EmailValidator
{
	private static ?UpstreamEmailValidator $instance = null;
	private static ?RFCValidation $rfc = null;

	public static function instance(): UpstreamEmailValidator
	{
		if (self::$instance instanceof UpstreamEmailValidator) {
			return self::$instance;
		}

		self::$instance = new UpstreamEmailValidator();

		return self::$instance;
	}

	public static function rfc(): RFCValidation
	{
		if (self::$rfc instanceof RFCValidation) {
			return self::$rfc;
		}

		self::$rfc = new RFCValidation();

		return self::$rfc;
	}
}
