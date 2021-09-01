<?php

namespace wh1110000\CmsL8\Observers;

use wh1110000\CmsL8\Observers\ModelObserver;

/**
 * Class SettingObserver
 * @package Workhouse\Settings\Observers
 */

class SettingObserver extends ModelObserver {

	/**
	 * Handle the user "retrieved" event.
	 *
	 * @param  $model
	 * @return void
	 */

	public function retrieved($model){

	}

	/**
	 * Handle the user "saved" event.
	 *
	 * @param  $model
	 * @return void
	 */

	public function saved($model){

	}

    /**
     * Handle the model "created" event.
     *
     * @param  $model
     * @return void
     */

    public function creating($model) {

    }

    /**
     * Handle the user "updated" event.
     *
     * @param $model
     * @return void
     */

    public function updating($model) {

    }

    /**
     * Handle the user "updated" event.
     *
     * @param $model
     * @return void
     */

    public function updated($model) {

    }

	/**
	 * @param $model
	 * @return void
	 */

    public function deleted($model) {

        //
    }

	/**
	 * @param $model
	 * @return void
	 */

    public function restored($model) {

        //
    }

	/**
	 * @param $model
	 * @return void
	 */

    public function forceDeleted($model) {

        //
    }
}
