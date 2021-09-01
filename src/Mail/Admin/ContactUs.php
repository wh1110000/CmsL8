<?php

namespace wh1110000\CmsL8\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

/**
 * Class ContactUs
 * @package Workhouse\Contact\Mail\Admin
 */

class ContactUs extends Mailable {

    use Queueable, SerializesModels;

	/**
	 * @var string
	 */

	public $first_name;

	/**
	 * @var string
	 */

	public $last_name;
	/**
	 * @var
	 */

	public $email;

	/**
	 * @var
	 */

	public $phone;

	/**
	 * @var
	 */

	public $enquiry;

	/**
	 * @var
	 */

	public $data;

	/**
	 * ContactUs constructor.
	 *
	 * @param $request
	 */

	public function __construct($request) {

		$form = $request->all();

		$this->first_name = (string) $request->input('first_name');

		$this->last_name = (string) $request->input('last_name');

		$this->email = (string) $request->input('email');

		$this->phone = (string) $request->input('phone');

		$this->enquiry = (string) $request->input('enquiry');

		$this->data = array_filter($form, function ($key){

			return !Str::startsWith($key, '_') && $key !== 'action';

		}, ARRAY_FILTER_USE_KEY);

	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */

	public function build() {

	    return $this->subject(__('Contact Us Form'))
	        ->replyTo($this->email, $this->first_name. ' '.$this->last_name)
	        ->view('emails::contact-us');
    }
}
