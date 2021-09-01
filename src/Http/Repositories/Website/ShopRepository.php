<?php

namespace wh1110000\CmsL8\Http\Repositories\Website;

use wh1110000\CmsL8\Http\Repositories\WebRepository;

/**
 * Class ShopRepository
 * @package Workhouse\Shops\Repositories\Website
 */

class ShopRepository extends WebRepository {

	/**
	 * @var null
	 */

	public $userLat = null;

	/**
	 * @var null
	 */

	public $userLong = null;

	/**
	 * @param null $slug
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function singleRecordPage( $slug = null, $render = true ) {

		$this->setView('single-shop');

		return parent::singleRecordPage( $slug, $render );
	}

	/**
	 * @param $shops
	 *
	 * @return mixed
	 */

	public function getMap($shops){

		$userLat = $this->userLat;

		$userLong = $this->userLong;

		$shopsList = json_encode($shops);

		return compact('shops', 'shopsList','userLong', 'userLat');
	}

	/**
	 * @param $locale
	 *
	 * @return bool|mixed
	 */

	public function getDefaultMapLocationForLocale( $locale ) {

		$startPoints = config( 'shop.map_start_points' );

		if( isset( $startPoints[$locale] )   ){
			return $startPoints[$locale];
		}

		return false;
	}

	/**
	 * @return bool
	 */

	public function searchMap(){

		return request()->get('postcode') || (request()->get('long') && request()->get('lat'));
	}

	/**
	 * @return array
	 */

	public function getSearchedResults(){

		$distance = 20; //miles

		if(request()->get('long') && request()->get('lat')){

			$this->userLat = request()->get('lat');
			$this->userLong = request()->get('long');
			$shops = $this->model->select('*')->selectRaw("(3959 * acos ( cos ( radians(?) ) * cos( radians(latitude) ) *  cos( radians( longitude ) - radians(?) )+ sin ( radians(?) ) * sin( radians( latitude ) ))) AS distance", [$this->userLat,$this->userLong,$this->userLat])->having('distance', '<', $distance)->orderBy('distance')->get();

		} else {

			$address = str_replace(" ", "+", request()->get('postcode'));

			$json = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=".app('SettingsManager')->get('GOOGLEMAPS_API_KEY')."&address=$address,europe&sensor=false");
			$json = json_decode($json);

			if( ! empty( $json->results )  ){
				$this->userLat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
				$this->userLong = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
				$shops = $this->model->select('*')->selectRaw("(3959 * acos ( cos ( radians(?) ) * cos( radians(latitude) ) *  cos( radians( longitude ) - radians(?) )+ sin ( radians(?) ) * sin( radians( latitude ) ))) AS distance", [$this->userLat,$this->userLong,$this->userLat])->having('distance', '<', $distance)->orderBy('distance')->get();

				if( count($shops) < 1 )
				{
					$distance = 50;
					$shops = $this->model->select('*')->selectRaw("(3959 * acos ( cos ( radians(?) ) * cos( radians(latitude) ) *  cos( radians( longitude ) - radians(?) )+ sin ( radians(?) ) * sin( radians( latitude ) ))) AS distance", [$this->userLat,$this->userLong,$this->userLat])->having('distance', '<', $distance)->orderBy('distance')->get();
				}

			}else{
				$shops = [];
			}

		}

		return $shops;
	}

	/**
	 * @return mixed
	 */

	public function getDefaultResults(){

		$defaultLocation = $this->getDefaultMapLocationForLocale( \App::getLocale() );

		if($defaultLocation){

			$userLat  = $defaultLocation['lat'];
			$userLong = $defaultLocation['long'];
			$distance = $defaultLocation['distance'];

			$shops = $this->model->select('*')->selectRaw("(3959 * acos ( cos ( radians(?) ) * cos( radians(latitude) ) *  cos( radians( longitude ) - radians(?) )+ sin ( radians(?) ) * sin( radians( latitude ) ))) AS distance", [$userLat,$userLong,$userLat])->having('distance', '<', $distance)->orderBy('distance')->get();

		} else {

			// absolute fallback, get the first few stores
			$shops = $this->model->limit ? $this->model->paginate($this->model->limit) : $this->model->get();
		}

		return $shops;
	}
}