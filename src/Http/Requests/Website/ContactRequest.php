<?php

namespace wh1110000\CmsL8\Http\Requests\Website;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class EmailRequest
 * @package Workhouse\Contact\Requests\Website
 */

class ContactRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
        'first_name' => ['required'],
        'last_name' => ['required'],
        'email' => ['required','email'],
        'enquiry' => ['required'],
        'g-recaptcha-response' => ['required','captcha']
	];
}
