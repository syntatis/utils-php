<?php

declare(strict_types=1);

namespace Syntatis\Utils\Tests;

use Error;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use stdClass;
use Syntatis\Utils\Val;

use function chr;
use function sprintf;
use function str_repeat;

class ValTest extends TestCase
{
	public function testInstantiate(): void
	{
		$this->expectException(Error::class);

		new Val();
	}

	/**
	 * @dataProvider dataIsEmailValid
	 * @testdox it can validate a valid email
	 *
	 * @param mixed $value
	 */
	public function testIsEmailValid($value): void
	{
		$this->assertTrue(Val::isEmail($value));
	}

	/**
	 * @dataProvider dataIsEmailInvalid
	 * @testdox it can validate a invalid email
	 *
	 * @param mixed $value
	 */
	public function testIsEmailInvalid($value): void
	{
		$this->assertFalse(Val::isEmail($value));
	}

	/**
	 * @dataProvider dataIsURLValid
	 * @testdox it can validate a valid url
	 *
	 * @param mixed $value
	 */
	public function testIsURLValid($value): void
	{
		$this->assertTrue(Val::isURL($value));
	}

	/**
	 * @dataProvider dataIsURLInvalid
	 * @testdox it can validate an invalid url
	 *
	 * @param mixed $value
	 */
	public function testIsURLInvalid($value): void
	{
		$this->assertFalse(Val::isURL($value));
	}

	/**
	 * @dataProvider dataIsBlank
	 * @testdox it can validate a blank value
	 *
	 * @param mixed $value
	 */
	public function testIsBlank($value): void
	{
		$this->assertTrue(Val::isBlank($value));
	}

	/**
	 * @dataProvider dataIsNotBlank
	 * @testdox it can validate that is a not blank value
	 *
	 * @param mixed $value
	 */
	public function testIsNotBlank($value): void
	{
		$this->assertFalse(Val::isBlank($value));
	}

	/**
	 * @dataProvider dataIsUUID
	 * @testdox it can validate a uuid value
	 *
	 * @param mixed $value
	 */
	public function testIsUUID($value): void
	{
		$this->assertTrue(Val::isUUID($value));
	}

	/**
	 * @dataProvider dataIsNotUUID
	 * @testdox it can validate a uuid value
	 *
	 * @param mixed $value
	 */
	public function testIsNotUUID($value): void
	{
		$this->assertFalse(Val::isUUID($value));
	}

	/**
	 * @dataProvider dataIsSemver
	 * @testdox it can validate a semver value
	 *
	 * @param  mixed $value
	 */
	public function testIsSemver($value): void
	{
		$this->assertTrue(Val::isSemVer($value));
	}

	/**
	 * @dataProvider dataIsNotSemver
	 * @testdox it can validate an invalid semver value
	 *
	 * @param mixed $value
	 */
	public function testIsNotSemver($value): void
	{
		$this->assertFalse(Val::isSemVer($value));
	}

	/**
	 * @dataProvider dataIsIpAddress
	 * @testdox it can validate a valid ip address
	 *
	 * @param mixed $value
	 */
	public function testIsIpAddress($value): void
	{
		$this->assertTrue(Val::isIPAddress($value));
	}

	/**
	 * @dataProvider dataIsNotIpAddress
	 * @testdox it can validate a invalid ip address
	 *
	 * @param mixed $value
	 */
	public function testIsNotIpAddress($value): void
	{
		$this->assertFalse(Val::isIPAddress($value));
	}

	/**
	 * @dataProvider dataIsUnique
	 * @testdox it can validate unique collection
	 *
	 * @param mixed $value
	 */
	public function testIsUnique($value): void
	{
		$this->assertTrue(Val::isUnique($value));
	}

	/**
	 * @dataProvider dataIsNotUnique
	 * @testdox it can validate non-unique collection
	 *
	 * @param mixed $value
	 */
	public function testIsNotUnique($value): void
	{
		$this->assertFalse(Val::isUnique($value));
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
		$this->assertTrue(Val::isUnique($value, $fields));
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
		$this->assertFalse(Val::isUnique($value, $fields));
	}

	public static function dataIsEmailValid(): array
	{
		return [
			['fabien@symfony.com'],
			['example@example.co.uk'],
			['fabien_potencier@example.fr'],
			['fab\'ien@symfony.com'],
			['fabien+a@symfony.com'],
			['exampl=e@example.com'],
			['â@iana.org'],

			// Should probably failed according to RFC5322.
			['"\""@iana.org'],
			['"\a"@iana.org'],
			['"test".test@iana.org'],
			['"test"."test"@iana.org'],
			['"username"@example.com'],
			['"user,name"@example.com'],
			['"user@name"@example.com'],
			['"user\"name"@example.com'],
			['"test\ test"@iana.org'],
			['"test".test@iana.org'],
		];
	}

	/** @see https://github.com/symfony/validator/blob/46c4193ec1eefdd7f9568261c685450d6f3b32c9/Tests/Constraints/EmailValidatorTest.php#L342 */
	public static function dataIsEmailInvalid(): array
	{
		return [
			[' '],
			[''],
			[null],
			['"\"@iana.org'],
			['"""@iana.org'],
			['"test""test"@iana.org'],
			['"test"' . chr(0) . '@iana.org'],
			['"test"test@iana.org'],
			['"test\"@iana.org'],
			['"user name"@example.com'],
			['(test_exampel@example.fr'],
			['.example@localhost'],
			['0'],
			['\r\n \r\n test@iana.org'],
			['\r\n \r\ntest@iana.org'],
			['\r\n test@iana.org'],
			['\r\ntest@iana.org'],
			['ex\ample@localhost'],
			['example((example))@fakedfake.co.uk'],
			['example(example]example@example.co.uk'],
			['example.@example.co.uk'],
			['example@example@example.co.uk'],
			['examp║le@symfony.com'],
			['test;123@foobar.com'],
			['test@example.com test'],
			['user   name@example.com'],
			['user  name@example.com'],
			['user name@example.com'],
			['user[na]me@example.com'],
			['usern,ame@example.com'],
			[chr(226) . '@iana.org'],
			['"\"@iana.org'],
			['"test""test"@iana.org'],
			['"test"' . chr(0) . '@iana.org'],
			['"test"test@iana.org'],
			['"test\"@iana.org'],
			['(test_exampel@example.fr)'],
			['.example@localhost'],
			['\r\n \r\n test@iana.org'],
			['\r\n \r\ntest@iana.org'],
			['\r\n test@iana.org'],
			['\r\ntest@iana.org'],
			['email.email@email."'],
			['ex\ample@localhost'],
			['example(example)example@example.co.uk'],
			['example.@example.co.uk'],
			['example@(fake).com'],
			['example@(fake.com'],
			['example@example@example.co.uk'],
			['example@local\host'],
			['example@localhost.'],
			['test;123@foobar.com'],
			['test@' . chr(226) . '.org'],
			['test@email<'],
			['test@email>'],
			['test@email{'],
			['test@example..com'],
			['test@foo;bar.com'],
			['test@iana.org  \r\n\r\n '],
			['test@iana.org \r\n '],
			['test@iana.org \r\n \r\n'],
			['test@iana.org \r\n'],
			['test@iana.org \r\n\r\n'],
			['test@iana/icann.org'],
			['user   name@example.com'],
			['user  name@example.com'],
			['user name@example.com'],
			['user[na]me@example.com'],
			['usern,ame@example.com'],
			['username@ example . com'],
			['username@example,com'],
			[chr(226) . '@iana.org'],
			[str_repeat('x', 254) . '@example.com'], // email with warnings

			// RFC5322 compliant, but evaluated as invalid with `FILTER_VALIDATE_EMAIL.`
			['fab\ ien@symfony.com'],
			['инфо@письмо.рф'],
			['müller@möller.de'],
			['1500111@профи-инвест.рф'],
			[sprintf('example@%s.com', str_repeat('ъ', 40))],
		];
	}

	/** @see https://github.com/symfony/validator/blob/46c4193ec1eefdd7f9568261c685450d6f3b32c9/Tests/Constraints/UrlValidatorTest.php#L98 */
	public static function dataIsURLValid(): array
	{
		return [
			['http://a.pl'],
			['http://www.example.com'],
			['http://tt.example.com'],
			['http://m.example.com'],
			['http://m.m.m.example.com'],
			['http://example.m.example.com'],
			['https://long-string_with+symbols.m.example.com'],
			['http://www.example.com.'],
			['http://www.example.museum'],
			['https://example.com/'],
			['https://example.com:80/'],
			['http://examp_le.com'],
			['http://www.sub_domain.examp_le.com'],
			['http://www.example.coop/'],
			['http://www.test-example.com/'],
			['http://www.symfony.com/'],
			['http://symfony.fake/blog/'],
			['http://symfony.com/?'],
			['http://symfony.com/search?type=&q=url+validator'],
			['http://symfony.com/#'],
			['http://symfony.com/#?'],
			['http://www.symfony.com/doc/current/book/validation.html#supported-constraints'],
			['http://very.long.domain.name.com/'],
			['http://localhost/'],
			['http://myhost123/'],
			['http://internal-api'],
			['http://internal-api.'],
			['http://internal-api/'],
			['http://internal-api/path'],
			['http://127.0.0.1/'],
			['http://127.0.0.1:80/'],
			['http://[::1]/'],
			['http://[::1]:80/'],
			['http://[1:2:3::4:5:6:7]/'],
			['http://sãopaulo.com/'],
			['http://xn--sopaulo-xwa.com/'],
			['http://sãopaulo.com.br/'],
			['http://xn--sopaulo-xwa.com.br/'],
			['http://пример.испытание/'],
			['http://xn--e1afmkfd.xn--80akhbyknj4f/'],
			['http://مثال.إختبار/'],
			['http://xn--mgbh0fb.xn--kgbechtv/'],
			['http://例子.测试/'],
			['http://xn--fsqu00a.xn--0zwm56d/'],
			['http://例子.測試/'],
			['http://xn--fsqu00a.xn--g6w251d/'],
			['http://例え.テスト/'],
			['http://xn--r8jz45g.xn--zckzah/'],
			['http://مثال.آزمایشی/'],
			['http://xn--mgbh0fb.xn--hgbk6aj7f53bba/'],
			['http://실례.테스트/'],
			['http://xn--9n2bp8q.xn--9t4b11yi5a/'],
			['http://العربية.idn.icann.org/'],
			['http://xn--ogb.idn.icann.org/'],
			['http://xn--e1afmkfd.xn--80akhbyknj4f.xn--e1afmkfd/'],
			['http://xn--espaa-rta.xn--ca-ol-fsay5a/'],
			['http://xn--d1abbgf6aiiy.xn--p1ai/'],
			['http://☎.com/'],
			['http://username:password@symfony.com'],
			['http://user.name:password@symfony.com'],
			['http://user_name:pass_word@symfony.com'],
			['http://username:pass.word@symfony.com'],
			['http://user.name:pass.word@symfony.com'],
			['http://user-name@symfony.com'],
			['http://user_name@symfony.com'],
			['http://u%24er:password@symfony.com'],
			['http://user:pa%24%24word@symfony.com'],
			['http://symfony.com?'],
			['http://symfony.com?query=1'],
			['http://symfony.com/?query=1'],
			['http://symfony.com#'],
			['http://symfony.com#fragment'],
			['http://symfony.com/#fragment'],
			['http://symfony.com/#one_more%20test'],
			['http://example.com/exploit.html?hello[0]=test'],
			['http://বিডিআইএ.বাংলা'],

			// Valid URL with whitespace.
			'\x20http://www.example.com' => ["\x20http://www.example.com"],
			'\x09\x09http://www.example.com.' => ["\x09\x09http://www.example.com."],
			'http://symfony.fake/blog/\x0A' => ["http://symfony.fake/blog/\x0A"],
			'http://symfony.com/search?type=&q=url+validator\x0D\x0D' => ["http://symfony.com/search?type=&q=url+validator\x0D\x0D"],
			'\x00https://example.com:80\x00' => ["\x00https://example.com:80\x00"],
			'\x0B\x0Bhttp://username:password@symfony.com\x0B\x0B' => ["\x0B\x0Bhttp://username:password@symfony.com\x0B\x0B"],
		];
	}

	public static function dataIsURLInvalid(): array
	{
		return [
			"' '" => [' '],
			"''" => [''],
			'example.com' => ['example.com'],
			'://example.com' => ['://example.com'],
			'http ://example.com' => ['http ://example.com'],
			'http:/example.com' => ['http:/example.com'],
			'http://example.com::aa' => ['http://example.com::aa'],
			'http://example.com:aa' => ['http://example.com:aa'],
			'ftp://example.fr' => ['ftp://example.fr'],
			'faked://example.fr' => ['faked://example.fr'],
			'http://127.0.0.1:aa/' => ['http://127.0.0.1:aa/'],
			'ftp://[::1]/' => ['ftp://[::1]/'],
			'http://[::1' => ['http://[::1'],
			'http://☎' => ['http://☎'],
			'http://☎.' => ['http://☎.'],
			'http://☎/' => ['http://☎/'],
			'http://☎/path' => ['http://☎/path'],
			'http://hello.☎' => ['http://hello.☎'],
			'http://hello.☎.' => ['http://hello.☎.'],
			'http://hello.☎/' => ['http://hello.☎/'],
			'http://hello.☎/path' => ['http://hello.☎/path'],
			'http://:password@symfony.com' => ['http://:password@symfony.com'],
			'http://:password@@symfony.com' => ['http://:password@@symfony.com'],
			'http://username:passwordsymfony.com' => ['http://username:passwordsymfony.com'],
			'http://usern@me:password@symfony.com' => ['http://usern@me:password@symfony.com'],
			'http://nota%hex:password@symfony.com' => ['http://nota%hex:password@symfony.com'],
			'http://username:nota%hex@symfony.com' => ['http://username:nota%hex@symfony.com'],
			'http://example.com/exploit.html?<script>alert(1);</script>' => ['http://example.com/exploit.html?<script>alert(1);</script>'],
			'http://example.com/exploit.html?hel lo' => ['http://example.com/exploit.html?hel lo'],
			'http://example.com/exploit.html?not_a%hex' => ['http://example.com/exploit.html?not_a%hex'],
			'http://' => ['http://'],
			'http://www..com' => ['http://www..com'],
			'http://www..example.com' => ['http://www..example.com'],
			'http://www..m.example.com' => ['http://www..m.example.com'],
			'http://.m.example.com' => ['http://.m.example.com'],
			'http://wwww.example..com' => ['http://wwww.example..com'],
			'http://.www.example.com' => ['http://.www.example.com'],
			'http://example.co-' => ['http://example.co-'],
			'http://example.co-/path' => ['http://example.co-/path'],
			'http:///path' => ['http:///path'],

			// Relative URLs.
			'/example.com' => ['/example.com'],
			'//example.com::aa' => ['//example.com::aa'],
			'//example.com:aa' => ['//example.com:aa'],
			'//127.0.0.1:aa/' => ['//127.0.0.1:aa/'],
			'//[::1' => ['//[::1'],
			'//hello.☎/' => ['//hello.☎/'],
			'//:password@symfony.com' => ['//:password@symfony.com'],
			'//:password@@symfony.com' => ['//:password@@symfony.com'],
			'//username:passwordsymfony.com' => ['//username:passwordsymfony.com'],
			'//usern@me:password@symfony.com' => ['//usern@me:password@symfony.com'],
			'//example.com/exploit.html?<script>alert(1);</script>' => ['//example.com/exploit.html?<script>alert(1);</script>'],
			'//example.com/exploit.html?hel lo' => ['//example.com/exploit.html?hel lo'],
			'//example.com/exploit.html?not_a%hex' => ['//example.com/exploit.html?not_a%hex'],
			'//' => ['//'],
		];
	}

	public static function dataIsBlank(): array
	{
		return [
			"''" => [''],
			"' '" => [' '],
			'[]' => [[]],
			'null' => [null],
			'false' => [false],

			// Whitespace characters.
			'\x20' => ["\x20"],
			'\x09\x09' => ["\x09\x09"],
			'\x0A' => ["\x0A"],
			'\x0D\x0D' => ["\x0D\x0D"],
			'\x00' => ["\x00"],
			'\x0B\x0B' => ["\x0B\x0B"],
		];
	}

	public static function dataIsNotBlank(): array
	{
		return [
			'foobar' => ['foobar'],
			'0' => [0],
			'0.0' => [0.0],
			"'0'" => ['0'],
			'1234' => [1234],
			'[1234]' => [[1234]],
			'true' => [true],
		];
	}

	public static function dataIsUUID(): array
	{
		return [
			'216fff40-98d9-11e3-a5e2-0800200c9a66' => ['216fff40-98d9-11e3-a5e2-0800200c9a66'],
			'e22a9860-8e9f-11ed-95f6-5d3ec56dc459' => ['e22a9860-8e9f-11ed-95f6-5d3ec56dc459'],
		];
	}

	public static function dataIsNotUUID(): array
	{
		return [
			'null' => [null],
			'bool' => [false],
			'int' => [12345],
			"' '" => [' '],
			"''" => [''],
			'{216fff40-98d9-11e3-a5e2-0800200c9a66}' => ['{216fff40-98d9-11e3-a5e2-0800200c9a66}'],
			'216fff4098d911e3a5e20800200c9a66' => ['216fff4098d911e3a5e20800200c9a66'],
			'216f-ff40-98d9-11e3-a5e2-0800-200c-9a66' => ['216f-ff40-98d9-11e3-a5e2-0800-200c-9a66'],
		];
	}

	public static function dataIsSemver(): array
	{
		return [
			'0.0.4' => ['0.0.4'],
			'1.2.3' => ['1.2.3'],
			'10.20.30' => ['10.20.30'],
			'1.1.2-prerelease+meta' => ['1.1.2-prerelease+meta'],
			'1.1.2+meta' => ['1.1.2+meta'],
			'1.1.2+meta-valid' => ['1.1.2+meta-valid'],
			'1.0.0-alpha' => ['1.0.0-alpha'],
			'1.0.0-beta' => ['1.0.0-beta'],
			'1.0.0-alpha.beta' => ['1.0.0-alpha.beta'],
			'1.0.0-alpha.beta.1' => ['1.0.0-alpha.beta.1'],
			'1.0.0-alpha.1' => ['1.0.0-alpha.1'],
			'1.0.0-alpha0.valid' => ['1.0.0-alpha0.valid'],
			'1.0.0-alpha.0valid' => ['1.0.0-alpha.0valid'],
			'1.0.0-alpha-a.b-c-somethinglong+build.1-aef.1-its-okay' => ['1.0.0-alpha-a.b-c-somethinglong+build.1-aef.1-its-okay'],
			'1.0.0-rc.1+build.1' => ['1.0.0-rc.1+build.1'],
			'2.0.0-rc.1+build.123' => ['2.0.0-rc.1+build.123'],
			'1.2.3-beta' => ['1.2.3-beta'],
			'10.2.3-DEV-SNAPSHOT' => ['10.2.3-DEV-SNAPSHOT'],
			'1.2.3-SNAPSHOT-123' => ['1.2.3-SNAPSHOT-123'],
			'1.0.0' => ['1.0.0'],
			'2.0.0' => ['2.0.0'],
			'1.1.7' => ['1.1.7'],
			'2.0.0+build.1848' => ['2.0.0+build.1848'],
			'2.0.1-alpha.1227' => ['2.0.1-alpha.1227'],
			'1.0.0-alpha+beta' => ['1.0.0-alpha+beta'],
			'1.2.3----RC-SNAPSHOT.12.9.1--.12+788' => ['1.2.3----RC-SNAPSHOT.12.9.1--.12+788'],
			'1.2.3----R-S.12.9.1--.12+meta' => ['1.2.3----R-S.12.9.1--.12+meta'],
			'1.2.3----RC-SNAPSHOT.12.9.1--.12' => ['1.2.3----RC-SNAPSHOT.12.9.1--.12'],
			'1.0.0+0.build.1-rc.10000aaa-kk-0.1' => ['1.0.0+0.build.1-rc.10000aaa-kk-0.1'],
			'99999999999999999999999.999999999999999999.99999999999999999' => ['99999999999999999999999.999999999999999999.99999999999999999'],
			'1.0.0-0A.is.legal' => ['1.0.0-0A.is.legal'],

			// With v* prefix
			'v0.0.4' => ['v0.0.4'],
			'v1.2.3' => ['v1.2.3'],
			'v10.20.30' => ['v10.20.30'],
			'v1.1.2-prerelease+meta' => ['v1.1.2-prerelease+meta'],
			'v1.1.2+meta' => ['v1.1.2+meta'],
			'v1.1.2+meta-valid' => ['v1.1.2+meta-valid'],
			'v1.0.0-alpha' => ['v1.0.0-alpha'],
			'v1.0.0-beta' => ['v1.0.0-beta'],
			'v1.0.0-alpha.beta' => ['v1.0.0-alpha.beta'],
			'v1.0.0-alpha.beta.1' => ['v1.0.0-alpha.beta.1'],
			'v1.0.0-alpha.1' => ['v1.0.0-alpha.1'],
			'v1.0.0-alpha0.valid' => ['v1.0.0-alpha0.valid'],
			'v1.0.0-alpha.0valid' => ['v1.0.0-alpha.0valid'],
			'v1.0.0-alpha-a.b-c-somethinglong+build.1-aef.1-its-okay' => ['v1.0.0-alpha-a.b-c-somethinglong+build.1-aef.1-its-okay'],
			'v1.0.0-rc.1+build.1' => ['v1.0.0-rc.1+build.1'],
			'v2.0.0-rc.1+build.123' => ['v2.0.0-rc.1+build.123'],
			'v1.2.3-beta' => ['v1.2.3-beta'],
			'v10.2.3-DEV-SNAPSHOT' => ['v10.2.3-DEV-SNAPSHOT'],
			'v1.2.3-SNAPSHOT-123' => ['v1.2.3-SNAPSHOT-123'],
			'v1.0.0' => ['v1.0.0'],
			'v2.0.0' => ['v2.0.0'],
			'v1.1.7' => ['v1.1.7'],
			'v2.0.0+build.1848' => ['v2.0.0+build.1848'],
			'v2.0.1-alpha.1227' => ['v2.0.1-alpha.1227'],
			'v1.0.0-alpha+beta' => ['v1.0.0-alpha+beta'],
			'v1.2.3----RC-SNAPSHOT.12.9.1--.12+788' => ['v1.2.3----RC-SNAPSHOT.12.9.1--.12+788'],
			'v1.2.3----R-S.12.9.1--.12+meta' => ['v1.2.3----R-S.12.9.1--.12+meta'],
			'v1.2.3----RC-SNAPSHOT.12.9.1--.12' => ['v1.2.3----RC-SNAPSHOT.12.9.1--.12'],
			'v1.0.0+0.build.1-rc.10000aaa-kk-0.1' => ['v1.0.0+0.build.1-rc.10000aaa-kk-0.1'],
			'v99999999999999999999999.999999999999999999.99999999999999999' => ['v99999999999999999999999.999999999999999999.99999999999999999'],
			'v1.0.0-0A.is.legal' => ['v1.0.0-0A.is.legal'],
		];
	}

	public static function dataIsNotSemver(): array
	{
		return [
			'null' => [null],
			'1' => ['1'],
			'1.2.3-0123' => ['1.2.3-0123'],
			'1.2.3-0123.0123' => ['1.2.3-0123.0123'],
			'1.1.2+.123' => ['1.1.2+.123'],
			'+invalid' => ['+invalid'],
			'-invalid' => ['-invalid'],
			'-invalid+invalid' => ['-invalid+invalid'],
			'-invalid.01' => ['-invalid.01'],
			'alpha' => ['alpha'],
			'alpha.beta' => ['alpha.beta'],
			'alpha.beta.1' => ['alpha.beta.1'],
			'alpha.1' => ['alpha.1'],
			'alpha+beta' => ['alpha+beta'],
			'alpha_beta' => ['alpha_beta'],
			'alpha.' => ['alpha.'],
			'alpha..' => ['alpha..'],
			'beta' => ['beta'],
			'1.0.0-alpha_beta' => ['1.0.0-alpha_beta'],
			'-alpha.' => ['-alpha.'],
			'1.0.0-alpha..' => ['1.0.0-alpha..'],
			'1.0.0-alpha..1' => ['1.0.0-alpha..1'],
			'1.0.0-alpha...1' => ['1.0.0-alpha...1'],
			'1.0.0-alpha....1' => ['1.0.0-alpha....1'],
			'1.0.0-alpha.....1' => ['1.0.0-alpha.....1'],
			'1.0.0-alpha......1' => ['1.0.0-alpha......1'],
			'1.0.0-alpha.......1' => ['1.0.0-alpha.......1'],
			'01.1.1' => ['01.1.1'],
			'1.01.1' => ['1.01.1'],
			'1.1.01' => ['1.1.01'],
			'1.2' => ['1.2'],
			'1.2.3.DEV' => ['1.2.3.DEV'],
			'1.2-SNAPSHOT' => ['1.2-SNAPSHOT'],
			'1.2.31.2.3----RC-SNAPSHOT.12.09.1--..12+788' => ['1.2.31.2.3----RC-SNAPSHOT.12.09.1--..12+788'],
			'1.2-RC-SNAPSHOT' => ['1.2-RC-SNAPSHOT'],
			'-1.0.3-gamma+b7718' => ['-1.0.3-gamma+b7718'],
			'+justmeta' => ['+justmeta'],
			'9.8.7+meta+meta' => ['9.8.7+meta+meta'],
			'9.8.7-whatever+meta+meta' => ['9.8.7-whatever+meta+meta'],
			'99999999999999999999999.999999999999999999.99999999999999999----RC-SNAPSHOT.12.09.1--------------------------------..12' => ['99999999999999999999999.999999999999999999.99999999999999999----RC-SNAPSHOT.12.09.1--------------------------------..12'],
		];
	}

	public static function dataIsIpAddress(): array
	{
		return [
			'127.0.0.1' => ['127.0.0.1'],
			'1.2.3.4' => ['1.2.3.4'],
			'2001:db8:3333:4444:5555:6666:7777:8888' => ['2001:db8:3333:4444:5555:6666:7777:8888'],
			'2001:db8:3333:4444:CCCC:DDDD:EEEE:FFFF' => ['2001:db8:3333:4444:CCCC:DDDD:EEEE:FFFF'],
			'::' => ['::'],
			'2001:db8::' => ['2001:db8::'],
			'::1234:5678' => ['::1234:5678'],
			'2001:db8::1234:5678' => ['2001:db8::1234:5678'],
			'2001:0db8:0001:0000:0000:0ab9:C0A8:0102' => ['2001:0db8:0001:0000:0000:0ab9:C0A8:0102'],
			'2001:db8:3333:4444:5555:6666:1.2.3.4' => ['2001:db8:3333:4444:5555:6666:1.2.3.4'],
			'::11.22.33.44' => ['::11.22.33.44'],
			'2001:db8::123.123.123.123' => ['2001:db8::123.123.123.123'],
			'::1234:5678:91.123.4.56' => ['::1234:5678:91.123.4.56'],
			'::1234:5678:1.2.3.4' => ['::1234:5678:1.2.3.4'],
			'2001:db8::1234:5678:5.6.7.8' => ['2001:db8::1234:5678:5.6.7.8'],
		];
	}

	public static function dataIsNotIpAddress(): array
	{
		return [
			'null' => [null],
			"''" => [''],
			"' '" => [' '],
			'false' => [false],
			'zero' => [0],
			'float' => [0.1],
			'array' => [[]],
			'object' => [new stdClass()],
			'99999999999999999999999' => ['99999999999999999999999'],
			'1.2.3.4.5' => ['1.2.3.4.5'],
			'1,2,3,4' => ['1,2,3,4'],
			'270.0.0.1' => ['270.0.0.1'],
		];
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
					],
				],
				['latitude', 'longitude'],
			],
			[
				[
					[
						'label' => 'foo',
						'latitude' => '3',
						'longitude' => '2',
					],
					['label' => 'bar'],
				],
				['latitude', 'longitude'],
			],
		];
	}

	public static function dataIsNotUnique(): array
	{
		return [
			'empty' => [[]],
			'non-array' => ['string'],
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
}
