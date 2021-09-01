<?php

namespace wh1110000\CmsL8\Services;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;

/**
 * Class Cast
 * @package Workhouse\Cms\Helpers
 */

class Cast {

	/**
	 * @var string
	 */

	static $format = 'd m y H:i';

	/**
	 * @param $type
	 * @param $value
	 *
	 * @return \Illuminate\Support\Carbon|int|Collection
	 */

	public static function attribute($type, $value) {

		if (is_null($value)) {

			return $value;
		}

		switch ($type) {

			case 'int':
			case 'integer':

				return (int) $value;

			case 'real':
			case 'float':
			case 'double':

				return self::fromFloat($value);

			case 'decimal':

				return self::asDecimal($value, 2);

			case 'string':

				return (string) $value;

			case 'bool':
			case 'boolean':

				return (bool) $value;

			case 'object':

				return self::fromJson($value, true);

			case 'array':
			case 'json':
			case 'media':

				return self::fromJson($value);

			case 'collection':

				return new Collection(self::fromJson($value));

			case 'date':

				return self::asDate($value);

			case 'datetime':

				return self::asDateTime($value);

			case 'timestamp':

				return self::asTimestamp($value);

			default:

				return $value;
		}
	}

	/**
	 * @param mixed $value
	 *
	 * @return string
	 */

	public static function asJson($value) {

		return json_encode($value);
	}

	/**
	 * Decode the given JSON back into an array or object.
	 *
	 * @param  string  $value
	 * @param  bool  $asObject
	 * @return mixed
	 */

	public static function fromJson($value, $asObject = false) {

		return json_decode($value, ! $asObject);
	}

	/**
	 * Decode the given float.
	 *
	 * @param  mixed  $value
	 * @return mixed
	 */

	public static function fromFloat($value) {

		switch ((string) $value) {

			case 'Infinity':

				return INF;

			case '-Infinity':

				return -INF;

			case 'NaN':

				return NAN;

			default:

				return (float) $value;
		}
	}

	/**
	 * Return a decimal as string.
	 *
	 * @param  float  $value
	 * @param  int  $decimals
	 * @return string
	 */

	public static function asDecimal($value, $decimals) {

		return number_format($value, $decimals, '.', '');
	}

	/**
	 * Return a timestamp as DateTime object with time set to 00:00:00.
	 *
	 * @param  mixed  $value
	 * @return \Illuminate\Support\Carbon
	 */

	public static function asDate($value) {

		return self::asDateTime($value)->startOfDay();
	}

	/**
	 * Return a timestamp as DateTime object.
	 *
	 * @param  mixed  $value
	 * @return \Illuminate\Support\Carbon
	 */

	public static function asDateTime($value) {

		// If this value is already a Carbon instance, we shall just return it as is.
		// This prevents us having to re-instantiate a Carbon instance when we know
		// it already is one, which wouldn't be fulfilled by the DateTime check.

		if ($value instanceof Carbon || $value instanceof CarbonInterface) {

			return Date::instance($value);
		}

		// If the value is already a DateTime instance, we will just skip the rest of
		// these checks since they will be a waste of time, and hinder performance
		// when checking the field. We will just return the DateTime right away.

		if ($value instanceof \DateTimeInterface) {

			return Date::parse($value->format('Y-m-d H:i:s.u'), $value->getTimezone());
		}

		// If this value is an integer, we will assume it is a UNIX timestamp's value
		// and format a Carbon object from this timestamp. This allows flexibility
		// when defining your date fields as they might be UNIX timestamps here.

		if (is_numeric($value)) {

			return Date::createFromTimestamp($value);
		}

		// If the value is in simply year, month, day format, we will instantiate the
		// Carbon instances from that format. Again, this provides for simple date
		// fields on the database, while still supporting Carbonized conversion.

		if (self::isStandardDateFormat($value)) {

			return Date::instance(Carbon::createFromFormat('Y-m-d', $value)->startOfDay());
		}

		$format = self::$format;

		// https://bugs.php.net/bug.php?id=75577
		if (version_compare(PHP_VERSION, '7.3.0-dev', '<')) {

			$format = str_replace('.v', '.u', $format);
		}

		// Finally, we will just assume this date is in the format used by default on
		// the database connection and use that format to create the Carbon object
		// that is returned back out to the developers after we convert it here.

		return Date::createFromFormat($format, $value);
	}

	/**
	 * Return a timestamp as unix timestamp.
	 *
	 * @param  mixed  $value
	 * @return int
	 */

	public static function asTimestamp($value) {

		return self::asDateTime($value)->getTimestamp();
	}

	/**
	 * Determine if the given value is a standard date format.
	 *
	 * @param  string  $value
	 * @return bool
	 */

	public static function isStandardDateFormat($value) {

		return preg_match('/^(\d{4})-(\d{1,2})-(\d{1,2})$/', $value);
	}
}