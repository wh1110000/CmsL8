<?php

namespace wh1110000\CmsL8\Http\Controllers\Website;

/**
 * Class ShopController
 * @package Workhouse\Shops\Website
 */

class ShopController extends Controller {

	/**
	 * @param $shop
	 *
	 * @return mixed
	 */

    public function shopShow($shop) {

    	$shop = $this->repository->getPost($shop);

	    $this->repository->render('show');

    	return $this->repository->view(compact('shop'));
    }

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function map() {

		if($this->repository->searchMap()){

			$results = $this->repository->getSearchedResults();

		} else {

			$results = $this->repository->getDefaultResults();
		}

		$data = array_merge(['page' => request()->get('currentPage')], $this->repository->getMap($results));

		return view('shop::map', $data);
	}
}
