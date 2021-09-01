<?php

namespace wh1110000\CmsL8\Http\Controllers\Website;

use Spatie\Searchable\SearchResultCollection;
use wh1110000\CmsL8\Services\Search;

/**
 * Class PageController
 * @package Workhouse\Pages\Controllers\Website
 */

class PageController extends Controller {

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function show($slug = null){

		return $this->repository->action($this);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function search() {

		$searchResults = new SearchResultCollection();

		if($query = request()->get('query')){

			$search = new Search();

			foreach (config('search') as $model => $fields){

				$model = '\\'.$model;

				$newModel = new $model;

				if(class_basename($newModel) == 'Article'){

					$newModel = \Article::type(class_basename($model));
				}

				$search->registerModel($newModel, $fields);


			}

			$searchResults = $search->search($query);
		}
		 $this->repository->render('search');

		return $this->repository->indexPage(compact('searchResults', 'query'));

	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function fallback(){

		return response( view('errors::404')->render(), 404 );
	}
}
