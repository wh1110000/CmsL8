<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

use Illuminate\Http\Request;
use wh1110000\CmsL8\Models\Presenters\Shop;
use wh1110000\CmsL8\Models\ShopOpeningHour;

/**
 * Class ShopController
 * @package Workhouse\Shops\Controllers\Admin
 */

class ShopController extends Controller {

	/**
	 * @param Shop $shop
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showDetailsTab($shop = null) {

		return $this->repository->detailsTab($shop);
	}

	/**
	 * @param Shop $shop
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showOpeningHoursTab($shop = null) {

		return $this->repository->openingHoursTab($shop);
	}

	/**
	 * @param Shop $shop
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showTestimonialsTab(Request $request, Shop $shop) {

		$testimonials = new \Testimonial;

		$testimonials = $testimonials->dataTable($shop);

		if($request->ajax()){

			return $testimonials;
		}

		return view('admin.shop::tabs.testimonials', compact('shop', 'testimonials'));
	}

	/**
	 * @param \ShopOpeningHour $day
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function destroyOpeningHours(\ShopOpeningHour $day) {

		return $this->repository->destroy($day);
	}

	/**
	 * @param Request $request
	 * @param Shop $shop
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function weekdaysModal(Request $request, Shop $shop) {

		return $this->repository->weekdaysModal($request, $shop);
	}

	/**
	 * @param Request $request
	 * @param Shop $shop
	 * @param ShopOpeningHour $day
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showBankholidaysModal(Request $request, Shop $shop, ShopOpeningHour $day) {

		return $this->repository->bankholidaysModal($request, $shop, $day);
	}
}
