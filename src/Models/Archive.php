<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Archive
 * @package Workhouse\Archives\Models
 */

class Archive extends BaseModel {

	use SoftDeletes;

	/**
	 * @var array
	 */

	protected $fillable = [
		'title',
		'short_description',
		'description',
		'featured',
		'published',
		'published_at',
		'link'
	];

	/**
	 * @var array
	 */

	protected $uploadable = [
		'thumbnail',
		'banner'
	];

	/**
	 * @var array
	 */

	protected $dates = [
		'published_at',
	];

	/**
	 * @var array
	 */

	protected $casts = [
		'author_id'  => 'integer',
		'featured'  => 'boolean',
		'published' => 'boolean',
	];

	/**
	 * @var array
	 */

	protected $attributes = [
		'featured'  => false,
		'published' => false,
	];

	/**
	 * Article constructor.
	 *
	 * @param array $attributes
	 */

	public function __construct( array $attributes = [] ) {

		if(isset($attributes['type'])){

			$this->generateModelData(Str::startsWith($attributes['type'], '\\') ? Str::replaceFirst('\\', '', $attributes['type']): $attributes['type']);

			unset($attributes['type']);
		}
		parent::__construct( $attributes );
	}

	/**
	 * @return mixed
	 */

	public function getAuthor(){

		return optional($this->author);
	}

	/**
	 * @return mixed
	 */

	public function getNext(){

		return $this->where('published_at', '<=', $this->getDate('published_at', false))->where('id', '<>', $this->getId())->orderBy('published_at', 'desc')->first();
	}

	/**
	 * @return mixed
	 */

	public function getPrevious(){

		return $this->where('published_at', '>=', $this->getDate('published_at', false))->where('id', '<>', $this->getId())->orderBy('published_at')->first();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function categories() {

		$table = $this->getBaseTable();

		$model = \Article::type($this->getModelName());

		return $this->belongsToMany(new $model, Str::finish($table,'_'.$table.'_category'), Str::finish($table, '_id'), Str::finish($table, '_category_id') );
		//return $this->belongsToMany(model($this->getModelName().'Category'), Str::finish($table,'_'.$table.'_categories'), Str::finish($table, '_category_id'), Str::finish($table, '_id') );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function countries() {

		$table = $this->getBaseTable();

		return $this->belongsToMany(new \Country, Str::finish($table,'_country'), Str::finish($table, '_id'));
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */

	public function author() {

		return $this->belongsTo( new \Administrator, 'author_id' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */

	public function publishedBy() {

		return $this->belongsTo( new \Administrator, 'published_by' );
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */

	public function scopeFeatured( $query ) {

		return $query->where( 'featured', true );
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */

	/*public function scopeIsPublished( $query, $notPublished = false ) {

		return $query->where( 'published', !$notPublished );
	}*/

	/**
	 * @param $query
	 *
	 * @return mixed
	 */

	/*public function scopeIsNotPublished( $query ) {

		return $this->scopeIsPublished($query, true);
	}*/

	/**
	 * @return mixed
	 */

	private function getBaseTable(){

		return app('DoctrineInflector')->singularize($this->table);
	}

	/**
	 * @param $postType
	 *
	 * @return Article
	 */

	public static function type($postType){

		$postType = implode(array_map(function($model) use ($postType ) {

			return $model == 'Archive' ? str_replace($model, $postType, $model) : $model;
		},
			preg_split('/(?=[A-Z])/',class_basename(get_called_class()))
		));

		$model = new self(['type' => $postType]);

		return $model;
	}

	/**
	 * @param $query
	 * @param int $limit
	 *
	 * @return mixed
	 */

	public function scopeGetLatest($query, $limit = 3){

		return $query->latest()->limit($limit);
	}

	/**
	 * @param $query
	 * @param int $limit
	 *
	 * @return mixed
	 */

	public function scopeRelated($query, $limit = 3){

		return $query->where('id', '!=', $this->getId())->limit($limit);
	}
}
