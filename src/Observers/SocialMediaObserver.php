<?php

namespace wh1110000\CmsL8\Observers;

/**
 * Class SocialMediaObserver
 * @package Workhouse\SocialMedia\Observers
 */

class SocialMediaObserver {

    /**
     * Handle the model "created" event.
     *
     * @param  $model
     * @return void
     */

    public function creating($model) {

    	$max = $model->max('order') ?? 0;

	    $model->order = $max + 1;
    }
}
