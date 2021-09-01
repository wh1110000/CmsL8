<?php

namespace wh1110000\CmsL8\Http\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class ShopRepository
 * @package Workhouse\Shops\Repositories\Admin
 */

class ShopRepository extends AdminRepository {

	/**
	 * @param null $slug
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function singleRecordPage( $slug = null, $render = true ) {

		$this->view = 'admin.shop::tabs.details';

		//$this->setView('tabs.details');

		return parent::singleRecordPage( $slug, $render );
	}

	/**
	 * @param $slug
	 *
	 * @return mixed
	 */

	public function detailsTab($slug){

		$this->setView('tabs.details');

		return $this->singleRecordPage($slug);
	}

	/**
	 * @param $slug
	 *
	 * @return mixed
	 */

	public function openingHoursTab($slug){

		$this->setView('tabs.opening_hours');

		return $this->singleRecordPage($slug);
	}

	/**
	 * @param $request
	 * @param $shop
	 * @param $day
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function bankholidaysModal($request, $shop, $day) {

		$result = false;

		$request->flash();

		if($request->action == 'add') {

			$day->fill($request->all());

			$day->shop_id = $shop->id;

			if($day->save()){

				$result = true;
			}
		}

		return view('admin.shop::modal.bankholidays', compact('shop', 'errors', 'result', 'day'));
	}

	/**
	 * @param $request
	 * @param $shop
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function weekdaysModal($request, $shop) {

		$result = false;

		$request->flash();

		if($request->action == 'add') {

			foreach($request->days as $day => $value){

				$shop->openingTimes()->where('day', $day)->update($value);
			}

			$result = true;
		}

		return view('admin.shop::modal.weekdays', compact('shop', 'errors', 'result'));
	}
}