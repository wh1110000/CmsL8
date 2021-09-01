<?php

namespace wh1110000\CmsL8\Observers;

use Illuminate\Support\Facades\Password;
use wh1110000\CmsL8\Observers\ModelObserver;

/**
 * Class AdministratorsObserver
 * @package Workhouse\Core\Observers
 */

class AdministratorsObserver extends ModelObserver {

    /**
     * Handle the user "created" event.
     *
     * @param $model
     * @return void
     */

    public function created($model) {

	    Password::broker('administrators')->sendResetLink(['email' => $model->getEmail()]);
    }
}
