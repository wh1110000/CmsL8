<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use wh1110000\CmsL8\Traits\Contact;
use wh1110000\CmsL8\Traits\User;

/**
 * Class Email
 * @package Workhouse\Contact\Models
 */

class Email extends BaseModel {

	use SoftDeletes, User, Contact;

	/**
	 * @var array
	 */

	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'phone',
		'subject',
		'enquiry',
		'data',
		'read',
		'type'
	];

	/**
	 * @var array
	 */

	protected $casts = [
		'data' => 'array',
		'read' => 'boolean'
	];

	/**
	 * @var array
	 */

	protected $attributes = array(
		'read' => false,
	);

	/**
	 * @var bool
	 */

	protected $hasSeo = false;

	/**
	 * @return mixed
	 */

	public function getSubject(){

		return ($this->subject ?? '(' . (__('contact::general.no_subject')).')');
	}

	/**
	 * @param int $limit
	 * @param string $end
	 *
	 * @return string
	 */

	public function getEnquiry($limit = 500, $end = '...'){

		$enquiry = $this->enquiry;

		return $enquiry ?: Str::limit(strip_tags($enquiry), $limit, $end);
	}

	/**
	 * @return mixed
	 */

	public function getData(){

		return $this->data;
	}

	/**
	 * @return mixed
	 */

	public function getType(){

		return $this->type;
	}

	/**
	 * @param $type
	 *
	 * @return bool
	 */

	public function isType($type) {

		return $this->type === $type;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function tags() {

		return $this->belongsToMany('\EmailTag');
	}

	/**
	 * @param $query
	 * @param $type
	 *
	 * @return mixed
	 */

	public function scopeMailType($query, $type){

		return $query->where('type', $type);
	}

	/**
	 * @param $query
	 * @param bool $read
	 *
	 * @return mixed
	 */

	public function scopeRead($query, $read = true){

		return $query->where('read', $read);
	}

	/**
	 * @param $query
	 * @param bool $important
	 *
	 * @return mixed
	 */

	public function scopeImportant($query, $important = true){

		return $query->where('important', $important);
	}
}