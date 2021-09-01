<?php

namespace wh1110000\CmsL8\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\FileBag;
//use wh1110000\CmsL8\Helpers\Uploader;

/**
 * Class GeneralRequest
 * @package Workhouse\Cms\Admin
 */

class GeneralRequest extends FormRequest {

	/**
	 * @var array
	 */

	protected $modelName;

	public $model;

	/**
	 * @var array
	 */

	public $defaultRules = [];

	/**
	 * @var array
	 */

	public $allowedRulesVariables = [];

	/**
	 * GeneralRequest constructor.
	 *
	 * @param array $query
	 * @param array $request
	 * @param array $attributes
	 * @param array $cookies
	 * @param array $files
	 * @param array $server
	 * @param null $content
	 */

	public function __construct( array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null ) {

		parent::__construct( $query, $request, $attributes, $cookies, $files, $server, $content );
		
		$this->modelName = (array) strtolower(str_replace('Request','',class_basename($this)));
	}

	/**
	 * @return bool
	 */

	public function authorize() {

        return true;
    }

	/**
	 * @return array
	 */

	public function validationData() {

		$except = [];

		$files = $this->allFiles();

		foreach ($this->modelName as $model) {

			foreach ( (array) optional( $this->{$model} )->files as $file ) {

				$newFile = $file.'_new';

				if ( array_key_exists( $newFile, $this->all() ) ) {

					if ( $this->hasFile( $newFile ) ) {

						$this->merge( [ $file => $this->{$newFile} ] );

						$files[ $file ] = $this->{$newFile};

						unset( $files[ $newFile ] );

						array_push( $except, $newFile );
					}
				}
			}
		}

		$this->files = new FileBag($files);

		$this->convertedFiles = $files;

		return $this->except($except);
	}

	/**
	 * @param Validator $validator
	 *
	 * @throws ValidationException
	 */

	protected function failedValidation(Validator $validator) {

		toast('Please fill all required fields...', 'warning');

		parent::failedValidation($validator);
	}

	/**
	 * @param $validator
	 */

	public function withValidator($validator) {

		/*$uploader = new Uploader( '_uploads' );

		foreach ($this->model as $model) {

			foreach ((array) optional($this->{$model})->files as $file){

				if(array_key_exists($file, $validator->valid())){

					if($this->hasFile($file)){

						$filename = $uploader->upload(null, $this->file($file));

						\Request::merge([$file => $filename])->flash();

						$this->{$file} = $filename;
					}
				}
			}
		}*/
	}

	/**
	 * @return array
	 */

	public function rules() {

		if(request()->has('translations')){

			$this->defaultRules = [];

			return $this->defaultRules;
		}

		foreach ($this->modelName as $model) {

			foreach ( (array) optional( $this->{$model} )->files as $file ) {

				if ( $this->hasFile( $file ) ) {

					$newRules = [];

					foreach ( $this->allowedRulesVariables[ $file ] as $key => $rules ) {

						$value = null;

						if ( is_string( $rules ) ) {

							$value = $rules;

						} elseif ( is_array( $rules ) ) {

							array_walk($rules, function (&$value, $newKey) use ($key) {

								$value = ($key == $newKey ? '' : $newKey . '=')  . $value;

							});

							$value = implode(',', $rules);
						}

						if (!is_null($value)) {

							$newRules[] = $key . ':' . $value;
						}
					}

					$this->defaultRules = array_merge_recursive($this->defaultRules, [$file => $newRules]);
				}
			}
		}


		if(!empty($this->inheritVariables)){

			$this->defaultRules = array_intersect_key($this->defaultRules, array_flip($this->inheritVariables));
		}

		return $this->defaultRules;
	}

	/**
	 * @return array
	 */

	public function getRules(){

		return $this->rules();
	}

	/**
	 * Get the validator instance for the request.
	 *
	 * @return \Illuminate\Contracts\Validation\Validator
	 *
	 * @throws \Illuminate\Contracts\Container\BindingResolutionException
	 */

	protected function getValidatorInstance() {

		if ($this->validator) {

			return $this->validator;
		}

		$factory = $this->container->make(ValidationFactory::class);

		if (method_exists($this, 'validator')) {

			$validator = $this->container->call([$this, 'validator'], compact('factory'));

		} else {

			$validator = $this->createDefaultValidator($factory);

			$validator->customAttributes = $this->attributes();
		}

		if (method_exists($this, 'withValidator')) {

			$this->withValidator($validator);
		}

		$this->setValidator($validator);

		return $this->validator;
	}
}
