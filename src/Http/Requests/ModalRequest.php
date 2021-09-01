<?php

namespace wh1110000\CmsL8\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\MessageBag;

/**
 * Class ModalRequest
 * @package Workhouse\Cms\Requests\Modal
 */

class ModalRequest extends FormRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [];

	/**
	 * @return bool
	 */

	public function authorize() {

        return true;
    }

	/**
	 * @param $validator
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function withValidator($validator) {

		view()->share('result', false);

		if($this->action && \session()->has('errors')){

			return redirect()->back()->withErrors(new MessageBag());
		}
	}

	/**
	 * @param Validator $validator
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	protected function failedValidation(Validator $validator) {

		if($this->action){

			view()->share('errors', $validator->errors());

			request()->session()->put('errors', $validator->errors());

			$this->action = null;

			return redirect()->back()->withInput(\Request::all());
		}
	}

	/**
	 * @return array|mixed
	 */

	public function rules() {

		if(!$this->action){

			return [];
		}

		return $this->defaultRules;
	}
}