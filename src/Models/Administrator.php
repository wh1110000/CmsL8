<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use wh1110000\CmsL8\Notifications\NewPasswordNotification;
use wh1110000\CmsL8\Traits\Contact;
use wh1110000\CmsL8\Traits\ModelHelper;
use wh1110000\CmsL8\Traits\User;

/**
 * Class Administrator
 * @package Workhouse\Cms\Models
 */

class Administrator extends Authenticatable {

    use Notifiable, User, Contact, HasRoles, ModelHelper;

	/**
	 * @var array
	 */

	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'password',
		'password_confirmation'
	];

	/**
	 * @var array
	 */

	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * @var bool
	 */

	public $hasSeo = false;

	/**
	 * @var bool
	 */

	public $hasMultilanguage = false;

	/**
	 * @return mixed
	 */

    public function getId(){

    	return $this->id;
    }

	/**
	 * @param string $token
	 */

	public function sendPasswordResetNotification($token)
	{
		$this->notify(new NewPasswordNotification($token));
	}
}
