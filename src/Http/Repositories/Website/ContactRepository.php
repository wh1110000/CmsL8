<?php

namespace wh1110000\CmsL8\Http\Repositories\Website;

use Illuminate\Support\Facades\Mail;

use wh1110000\CmsL8\Mail\Admin\ContactUs;
use wh1110000\CmsL8\Http\Repositories\WebRepository;

/**
 * Class ContactRepository
 * @package Workhouse\Contact\Repositories\Website
 */

class ContactRepository extends WebRepository {


		public function submitForm($email = null){

		$email = $email ?: app('SettingsManager')->get('EMAIL');

		if(!$email){

			throw new \Exception('Something went wrong');
		}
			$request = is_object($this->requestClass) ? \App::make(get_class($this->requestClass)) : request();
			
			Mail::to($email)->send(new ContactUs($request));

			$_request = array_filter($request->all(), function ($key){

				return !in_array($key, ['_token', 'g-recaptcha-response']);

			}, ARRAY_FILTER_USE_KEY);

			$inbox = new \Email;

			$data = array_intersect_key($_request, array_flip($inbox->getFillable() ?? []));

			$data['data'] = array_diff_key($_request, $data);

			$inbox->fill(array_merge($data, ['type' => 'inbox']))->save();

			return redirect()->route('contact.thankyou');
	
	}

	/**
	 * @return bool
	 */

	public function joinNewsletter(){

		$request = $this->getRequest();

		if(class_exists('Workhouse\Newsletter\Presenters\NewsletterSubscriber')){

			if($request->newsletter){

				$newsletter = \NewsletterSubscriber::where('email', $request->email)->firstOrCreate(['email' => $request->email], $request->only(['first_name', 'last_name']));

				return $newsletter->wasRecentlyCreated;
			}
		}

		return false;
	}

	/**
	 * @return mixed
	 */

	public function thankYou(){

		$this->setView('thank-you');

		$page = \Page::where('link', 'contact')->first();

		return $this->view(compact('page'));
	}
}