<?php

namespace wh1110000\CmsL8\Http\Middleware;

use GuzzleHttp\Client;
use wh1110000\CmsL8\Services\Route;

/**
 * Class geoIP
 * @package Workhouse\Multilanguage\Middleware
 */

class geoIP extends localeRedirect {

	/**
	 * @return bool
	 */

	public function allowLanguageChecking(){

		return Route::isWebRoute();
	}

	/**
	 * @return bool|string
	 */

	protected function getDefaultLocale() {

		return $this->getLocationFromIP( \Request::ip() );
	}


	/**
	 * @param $ip
	 *
	 * @return bool|string - returns locale which the user should be redirected to or false
	 */

	protected function getLocationFromIP( $ip ){

		// $ip = '146.255.105.9'; // manchester
		// $ip = '23.105.223.255';// canada
		// $ip = '5.28.64.0';     // germany
		// $ip = '2.159.255.255'; // italy
		// $ip = '62.9.255.255';  // ireland

		// check that we havent already searched and cached the location for this ip address first

		$geoipconfig = config( 'geoip' );

		$cacheKey = 'GEOIP_LOOKUP____' . md5( $ip  . serialize( $geoipconfig ));

		if( \Cache::has( $cacheKey ) ){

			\Log::info('ip cached --- ' . $ip . '  -- ' . \Cache::get($cacheKey) );

			return \Cache::get($cacheKey);
		}

		\Log::info('ip not cached --- ' . $ip );

		$apiKey = config('geoip.api_key');

		try
		{

			$client = new Client([
				'timeout'  => 2.0,
			]);

			/*
			 * perform lookup
			*  http://api.ipstack.com/134.201.250.155?access_key=YOUR_ACCESS_KEY
			*/

			$response = $client->request( 'GET', 'http://api.ipstack.com/' . $ip . '?access_key=' . $apiKey);

			$data = json_decode($response->getBody());

			if( property_exists($data, 'country_code'	) ){

				$countryCode = $data->country_code;

				$languageCode = $this->resolveLocaleFromCountry($countryCode);

				\Cache::put( $cacheKey, $languageCode, config('geoip.ip_lookup_cache_duration') );

				$this->urlLocale = $countryCode;

				$this->locale = $languageCode;

				return $this->translationBy == 'country' ? $countryCode : $languageCode;
			}

		}catch( \Exception $e){


			\Log::error( 'Exception in Workhouse\GeoIP\Http\Middleware -- '  . $e->getMessage() );
		}

		// as a failsafe returning false will result in no redirect
		\Log::error( 'No redirect performed or exception occured'  );

		return false;
	}
}
