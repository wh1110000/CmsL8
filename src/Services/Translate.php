<?php

namespace wh1110000\CmsL8\Services;
use Illuminate\Support\Str;

use wh1110000\CmsL8\Services\Route as NewRoute;

/**
 * Class Translate
 * @package Workhouse\Multilanguage\Services
 */

class Translate {

	/**
	 * @var
	 */

	private $manager;

	/**
	 * @var
	 */

	private $active;

	/**
	 * Translate constructor.
	 */

	public function __construct() {

		$translationBy = config('app.translationby') ?? 'country';

		if($translationBy === false){

			$this->manager = false;

		} elseif($translationBy) {

			$this->manager = $translationBy == 'country' ? \Country::query() : \Language::query();
		}

		$this->active = $this->manager->active()->orderBy( 'priority' , 'asc')->orderBy( 'name' )->get();
   }

	/**
	 * @param bool $excludeCurrent
	 *
	 * @return mixed
	 */

   public function getAll($excludeCurrent = false){

   	    $query = $this->active;

	    if(is_array($excludeCurrent)){

		    $excludeCurrent = array_filter($excludeCurrent);

		    if($excludeCurrent){

		        $query = $query->whereNotIn('code', $excludeCurrent);
		    }

	    } else{

	    	if($excludeCurrent != false){

	    		$query = $query->where('code', '!=', $excludeCurrent == true ? $this->getActiveUrlLocale() : $excludeCurrent);
		    }
	    }

		return $query;
   }

	/**
	 * @return string
	 */

	public function getActiveUrlLocale(){

		if(NewRoute::isAdminRoute()){

			if(request()->has('translations')){

				return request()->get('translations');
			}
		}

		return request()->urlLocale ?: Str::before(Str::finish(request()->path(), '/'), '/');
	}

	public function getActiveLanguage(){

		return $this->getActiveUrlLocale();
	}

	/**
	 * @param $slug
	 *
	 * @return string
	 */

   public function slug($slug){

   	    if($this->manager){

   	        return 'terms-and-conditions';
        }

        return $slug;
   }


}
