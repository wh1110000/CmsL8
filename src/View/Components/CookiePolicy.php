<?php

namespace wh1110000\CmsL8\View\Components;

use Illuminate\View\Component;

class CookiePolicy extends Component {

	/**
	 * @var string
	 */

	public static $cookieName = 'COOKIE_CACHE_NAME';

	/**
	 * @var bool
	 */

	public static $disabled;


	/**
     * Create a new component instance.
     *
     * @return void
     */

	public function __construct($disabled = false) {

		if($disabled){

			self::$disabled = $disabled;

		} else {

			self::$disabled = self::isAccepted();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render() {

        return view('cookiePolicy::cookie-policy-popup');
    }

    public static function isAccepted(){

    	if(self::$disabled){

    		return false;

	     } else {

	        if(isset($_COOKIE[self::getCookieName()])){

	            return filter_var($_COOKIE[self::getCookieName()], FILTER_VALIDATE_BOOLEAN);
		    }
	    }

	    return null;
    }

	/**
	 * @return string
	 */

    public static function getCookieName(){

    	return self::$cookieName;
    }

	protected function extractPublicProperties() {

		$class = get_class( $this );

		if ( ! isset( static::$propertyCache[ $class ] ) ) {

			$reflection = new \ReflectionClass( $this );

			static::$propertyCache[ $class ] = collect( $reflection->getProperties( \ReflectionProperty::IS_PUBLIC ) )
				->reject( function ( \ReflectionProperty $property ) {
					return $this->shouldIgnore( $property->getName() );
				} )
				->map( function ( \ReflectionProperty $property ) {
					return $property->getName();
				} )->all();
		}

		$values = [];


		foreach ( static::$propertyCache[ $class ] as $property ) {

			$values[ $property ] = ($reflection->getProperty($property)->isStatic() ? self::${$property} : $this->{$property}) ?? null;
		}

		return $values;
	}
}
