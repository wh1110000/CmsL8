<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection as BaseCollection;
use Spatie\Searchable\Searchable;
use wh1110000\CmsL8\Traits\Address;
use wh1110000\CmsL8\Traits\Contact;
use wh1110000\CmsL8\Traits\Property;
use wh1110000\CmsL8\Traits\Search;
use wh1110000\CmsL8\Scopes\Website\isApprovedScope;
use wh1110000\CmsL8\Scopes\Website\isPublishedScope;
use wh1110000\CmsL8\Scopes\Website\orderedScope;
use wh1110000\CmsL8\Services\Route;
use wh1110000\CmsL8\Traits\Content;
use wh1110000\CmsL8\Traits\ModelHelper;
use wh1110000\CmsL8\Traits\Slug;
use wh1110000\CmsL8\Traits\Media;
use wh1110000\CmsL8\Traits\Multilanguage;
use wh1110000\CmsL8\Traits\Seo;

/**
 * Class BaseModel
 * @package Workhouse\Core\Models
 */

class BaseModel extends Model implements Searchable {

	use Slug, ModelHelper, Multilanguage, Seo, Content, Search, Media, Property, Address, Contact;

	/**
	 * @var
	 */

	protected $imgFolder;

	/**
	 * @var array
	 */

	protected $uploadable = [];

	/**
	 * @var array
	 */

	protected $files = [];

	/**
	 * @var array
	 */

	protected $casts = [
		'gallery' => 'array',
		'approved' => 'boolean',
		'published' => 'boolean',
		'user_id' => 'integer',
		'published_by' => 'integer',
	];

	/**
	 * @var array
	 */

	public $tabsOrder = [

	];

	/**
	 * @var bool
	 */

	protected $orginalLink = false;

	/**
	 * @var array
	 */

	protected $dates = [
		'published_at',
	];

	/**
	 *
	 */

	protected static function booted() {

		if(Route::isWebRoute()) {

			static::addGlobalScope( new isPublishedScope() );
			static::addGlobalScope( new orderedScope() );
			static::addGlobalScope( new isApprovedScope() );
		}
	}

	public function __construct( array $attributes = [] ) {

		parent::__construct( $attributes );

		if(property_exists($this, 'mergeCasts')){

			$this->mergeCasts($this->mergeCasts);

		}
	}



	/**
	 * @return mixed
	 */

	public function getId(){

		return $this->id;
	}

	/**
	 * @return mixed
	 */

	public function getStatus(){

		return $this->status;
	}

	/**
	 * @return mixed
	 */

	public function published() {

		return  $this->published;
	}

	/**
	 * @return mixed
	 */

	public function approved(){

		return $this->approved;
	}

	/**
	 * @param $key
	 *
	 * @return bool
	 */

	public function isStatus($key){

		return $this->status === $key;
	}

	/**
	 * @param $key
	 * @param string $format
	 *
	 * @return mixed|null
	 */

	public function getDate($key, $format = 'd M Y'){

		if(!is_null($this->{$key})){

			$date = $this->{$key};

			if(is_string($format)){

				$date = $date->format($format);
			}

			return $date;
		}

		return null;
	}

	/**
	 * @return HasOne
	 */

	public function publishedBy(){

		return $this->hasOne('\Administrator', 'id', 'published_by');
	}

	/**
	 * @return array
	 */

	public function getUploadable(){

		return array_merge($this->uploadable, $this->files);
	}

	/**
	 * @return array
	 */

	public function getFillable() {

		return array_merge($this->getUploadable(), $this->fillable);
	}

	/**
	 * @return string
	 */

	public function getRouteKeyName(){

		return in_array('link', $this->getFillable()) ? 'link' : parent::getRouteKeyName();
	}

	/*LARAVEL METHODS*/

	/**
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return \Illuminate\Support\Carbon|mixed
	 */

	protected function transformModelValue($key, $value) {


		if($key != 'id' && app('multilanguage')->getActiveUrlLocale() != env('DEFAULT_URL_LOCALE') && array_key_exists('translations', $this->relations) ){

			$translatableFields = array_merge($this->getTranslatableFields(), $this->hasSeo() ? ['meta_title', 'meta_description'] : []);

			if(in_array($key, $translatableFields)){

				if($translation = $this->translations->where('field', $key)->first()){

					$value = $translation->text;
				}
			}
		}

		// If the attribute has a get mutator, we will call that then return what
		// it returns as the value, which is useful for transforming values on
		// retrieval from the model to a form that is more useful for usage.
		if ($this->hasGetMutator($key)) {
			return $this->mutateAttribute($key, $value);
		}

		// If the attribute exists within the cast array, we will convert it to
		// an appropriate native PHP type dependent upon the associated value
		// given with the key in the pair. Dayle made this comment line up.


		if ($this->hasCast($key)) {

			return $this->castAttribute($key, $value);
		}

		// If the attribute is listed as a date, we will convert it to a DateTime
		// instance on retrieval, which makes it quite convenient to work with
		// date fields without having to create a mutator for each property.
		if ($value !== null
		    && \in_array($key, $this->getDates(), false)) {
			return $this->asDateTime($value);
		}

		return $value;
	}

	/**
	 * @param mixed $value
	 * @param null $field
	 *
	 * @return Model|null
	 */

	public function resolveRouteBinding($value, $field = NULL) {

		$model = null;

		$exists = $this->where($field ?? $this->getRouteKeyName(), $value);

		if(!Route::isAdminRoute() && app('multilanguage')->getActiveUrlLocale() !==  env('DEFAULT_URL_LOCALE') && ($this->hasMultilanguage() && in_array($this->getRouteKeyName(), $this->getTranslatableFields()))) {

			$query = $this->whereHas('translations', function ($model) use ($value) {

				return $model->where('field', $this->getRouteKeyName())->whereText($value);
			});

			if($query->exists()){

				return $query;
			}

			$query = clone $exists;


			if($query->whereHas('translations', function ($model) use ($value) {

				return $model->where('field', $this->getRouteKeyName());

			})->exists()){

				abort(404);

				exit();
			}
		}


		return $exists;
	}

	/**
	 *
	 */

	protected function updateTimestamps() {

		$time = $this->freshTimestamp();

		$updatedAtColumn = $this->getUpdatedAtColumn();

		if (!is_null($updatedAtColumn) && $this->isDirty($updatedAtColumn)) {

			$this->setUpdatedAt($time);
		}

		$createdAtColumn = $this->getCreatedAtColumn();

		if (!$this->exists && !is_null($createdAtColumn) && !$this->isDirty($createdAtColumn)) {

			$this->setCreatedAt($time);
		}
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Builder
	 */

	public function newQuery() {

		if($this->hasMultilanguage()) {

			if (request('translations') || in_array( app('multilanguage')->getActiveUrlLocale(), app('multilanguage')->getAll([env('DEFAULT_URL_LOCALE')])->pluck('code')->toArray())) {

				array_push( $this->with, 'translations' );
			}
		}


		/*if($this->hasSeo()){

			array_push( $this->with, 'seo' );
		}*/

		return $this->registerGlobalScopes($this->newQueryWithoutScopes());
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return array|mixed
	 */

	protected function castAttribute($key, $value) {

		$castType = $this->getCastType($key);

		if (is_null($value) && in_array($castType, static::$primitiveCastTypes)) {

			return $value;
		}

		switch ($castType) {
			case 'int':
			case 'integer':
				return (int) $value;
			case 'real':
			case 'float':
			case 'double':
				return $this->fromFloat($value);
			case 'decimal':
				return $this->asDecimal($value, explode(':', $this->getCasts()[$key], 2)[1]);
			case 'string':
				return (string) $value;
			case 'bool':
			case 'boolean':
				return (bool) $value;
			case 'object':
				return $this->fromJson($value, true);
			case 'array':
			case 'json':
				return $this->fromJson($value);
			case 'collection':
				return new BaseCollection($this->fromJson($value));
			case 'date':
				return $this->asDate($value);
			case 'datetime':
			case 'custom_datetime':
				return $this->asDateTime($value);
			case 'timestamp':
				return $this->asTimestamp($value);
			case 'media':
				return optional(app('MediaLibrary')->where('id', $value))->first();
			case 'mediaArray':

				$value = is_array($value) ? $value : [$value];

				$array = [];

				foreach($value as $id){

					if($media = app('MediaLibrary')->where('id', $id)->first()){

						$array[] = $media;
					}
				}

				return $array;
		}

		if ($this->isClassCastable($key)) {

			return $this->getClassCastableAttributeValue($key, $value);
		}

		return $value;
	}

}
