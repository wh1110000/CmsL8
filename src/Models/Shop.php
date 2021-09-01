<?php

namespace wh1110000\CmsL8\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Shop
 * @package Workhouse\Shops\Models
 */

class Shop extends BaseModel {

	use SoftDeletes;

	/**
	 * @var array
	 */

	protected $fillable = [
		'shop_category_id',
		'name',
		'description',
		'short_description',
		'manager_name',
		'street',
		'street_extra',
		'postcode',
		'city',
		'county',
		'country_id',
		'phone',
		'email',
		'fax',
		'url_protocol',
		'url',
		'latitude',
		'longitude',
		'link',
		'department',
	];

	/**
	 * @var array
	 */

	protected $uploadable = [
		'image'
	];

	/**
	 * @var array
	 */

	protected $casts = [
		'shop_category_id' => 'integer',
		'country_id' => 'integer',
		'department' => 'boolean'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */

	public function openingTimes() {

		return $this->hasMany(new \ShopOpeningHour);
	}

	/**
	 * @return $this|\Illuminate\Database\Eloquent\Relations\HasMany
	 */

	public function testimonials() {

		if(class_exists('Workhouse\Testimonials\Presenters\Testimonial')){

			return $this->hasMany(new \Testimonial);
		}

		return $this;
	}

	/**
	 * @param int $limit
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */

	public function getTestimonials($limit = 3, $order = 'rand'){

		$testimonials = $this->testimonials();

		if($testimonials){

			switch($order){

				case 'rand':

					$testimonials->inRandomOrder();

					break;

				case 'asc':

					$testimonials->orderBy('created_at', $order);

					break;

				default:

					$testimonials->orderBy('created_at', 'desc');
			}

			$testimonials = $testimonials->limit($limit)->get();

			return $testimonials;
		}

		return null;
	}

	/**
	 * @return array
	 */

	public function getOpeningHours() {

		$times = [
			'bank_holidays' => [],
			'weekdays' => [],
		];

		$weekDays = $this->openingTimes()->orderBy('day', 'ASC')->whereNull('date')->get();

		$rangeIndex = 1;

		$ranges = [];
		
		foreach ($weekDays as $_day) {

			if(empty($ranges)) {

				$ranges[$rangeIndex][] = $_day;

				continue;
			}

			$start = strtotime($_day->open_time);

			$end = strtotime($_day->close_time);

			$prev = last($ranges[$rangeIndex]);

			if ($start !== strtotime($prev->open_time) || $end !== strtotime($prev->close_time) || ($prev->day !== $_day->day-1)){

				$rangeIndex++;
			}

			$ranges[$rangeIndex][] = $_day;
		}

		foreach($ranges as $range) {

			$from = reset($range);
			$to = end($range);

			$day['id'] = $from->id;

			if(isset($to)){

				$day['label'] = ($from->label ?? date('l', strtotime("Sunday +".$from->day." days"))) . ($from != $to ? ' - ' . date('l', strtotime("Sunday +".$to->day." days")) : '');

			} else {

				$day['label'] = ($from->label ?? date('l', strtotime("Sunday +".$from->day." days")));
			}

			$day['id'] = $from->id;
			$day['open'] = $from->open_time;
			$day['close'] = $to->close_time;

			$day['open_formatted'] = Carbon::parse($from->open_time)->format('g:ia');
			$day['close_formatted'] = Carbon::parse($from->close_time)->format('g:ia');

			$times['weekdays'][] = $day;
		}

		foreach($this->openingTimes()->whereNotNull('date')->get() as $range) {

			$times['bank_holidays'][] = [
				'label' => ($range->label ? $range->label .' - ': '') .Carbon::parse($range->date)->format('d M Y'),
				'open' => $range->open_time,
				'close' => $range->close_time,
				'id' => $range->id
			];
		}

		return $times;
	}

	/**
	 * @param $day
	 * @param bool $dayName
	 *
	 * @return string
	 */

	public function getDayOfWeek($day, $dayName = false) {

		$date = Carbon::now()->startOfWeek()->subDays($day);

		if($dayName){

			return $date->format('l');
		}

		return $this->openingTimes->where('day', $date->format('N'))->first();
	}

	/**
	 * @param $category
	 *
	 * @return mixed
	 */

	public function hasCategory($category){

		return optional($this->shopCategory)->getId() == $category->getId();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */

	public function shopCategory(){

		return $this->belongsTo(new \ShopCategory);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */

	public function country(){

		return $this->belongsTo(new \Country);
	}
}
