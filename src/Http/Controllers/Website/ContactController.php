<?php

namespace wh1110000\CmsL8\Http\Controllers\Website;

/**
 * Class ContactController
 * @package Workhouse\Contact\Controllers\Website
 */

class ContactController extends Controller {

	/**
	 * @return $this
	 */

	public function index(){

		$page = request()->get('currentPage');

		return view('contact::index', compact('page'));
	}


	public function submit(){

		if($this->repository->submitForm()){

			$this->repository->joinNewsletter();

			return redirect()->route('contact.thankyou')->with('toast_success', 'Message has been sent...');
		}

		return redirect()->back()->withInput(request()->all())->with('toast_error', 'Something went wrong...');
	}

	/**
	 * @return mixed
	 */

	public function thankYou(){

		return $this->repository->thankYou();
	}
}
