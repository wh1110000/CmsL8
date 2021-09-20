<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Page
 * @package Workhouse\Pages\Models
 */

class Page extends BaseModel {

	use SoftDeletes;

	/**
	 * @var array
	 */

	protected $fillable = [
		'parent_id',
		'title',
		'excerpt',
		'short_description',
		'content',
		'thumbnail',
		'banner',
		'type',
		'link',
		'published',
		'access'
	];

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

	protected $with = [
		'properties',
		'slug',
		'permissions'
	];

	/**
	 * @param string $method
	 * @param array $parameters
	 *
	 * @return array|mixed
	 */

	public function __call( $method, $parameters ) {

		if(Str::endsWith($method, 'Form')){

			if (method_exists(self::class, $method)) {

				return $this->row = $this->$method();
			}

			return $this->row;

		}

		return parent::__call( $method, $parameters );
	}

	/**
	 * @param $type
	 *
	 * @return bool
	 */

	public function isType($type) {

		return $this->getType() === $type;
	}

	/**
	 * @return mixed
	 */

	public function getType($detailed = false){

		$type = $this->exists ? $this->package : (request()->has('type') ? request()->get('type') : '');

		if(!$detailed){

			return $type;
		}

		/*switch ($type){

			case 'global':

				return $this->getLink();

			case 'internal' :

				return $this->getLink();
		}*/

		return $this->getLink();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */

	public function permissions(){

		return $this->hasMany('\PagePermission');
	}

	/**
	 * @return mixed
	 */

	public function hasNotPermissions(){

		$locale = request('locale') ?? \App::getLocale();

		return $this->permissions->pluck('lang')->contains($locale);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */

	public function children(){

		return $this->hasMany('\Page', 'parent_id', 'id' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */

	public function parent(){

		return $this->hasOne('\Page', 'id', 'parent_id' );
	}

	/**
	 * @return mixed
	 */

	public function related(){

		return $this->parent->children()->whereNotIn('id', [$this->getId()]);
	}

	/**
	 * @return array|mixed
	 */

	public function metaFieldsForm(){

		return $this->isType('external') ? []: parent::metaFieldsForm();
	}

	/**
	 * @param $query
	 * @param array $links
	 *
	 * @return mixed
	 */

	public function scopeFindByLinks($query, $links = []) {

		if(is_array($links)){

			return $query->whereIn('link', $links)->get();

		} else {

			return optional($query->where('link', '=', $links)->first());
		}
	}

	/**
	 * @param $query
	 * @param $link
	 *
	 * @return bool
	 */

	/*public function scopeExists($query, $link) {

		return (bool) $query->where('link', '=', $link)->first();
	}*/

	/**
	 * @param $query
	 * @param $link
	 *
	 * @return mixed
	 */

	/*public function scopeGetPackage($query, $package, $type = null) {

		$query = $query->withoutGlobalScopes()->where('package', '=', $package);

		if($type){

			$query = $query->where('type', $type);
		}

		if($type == 'member')
		dd($query->dd());

		return $query->first();
	}*/

	/*public function valuesForm(){

		$this->row->addCol(12)
	       ->addSection(__('core::general.banner444'))
	       ->addField(\Fields::repeater('sectors', ['text' => 'title', 'editor' => 'description']));
	}*/

	public function getAccess(){

		return $this->access;
	}
}

