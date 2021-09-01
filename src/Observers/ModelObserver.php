<?php

namespace wh1110000\CmsL8\Observers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

/**
 * Class ModelObserver
 * @package Workhouse\Cms\Observers
 */

class ModelObserver {

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

		if($model->hasSeo()){

			$meta = request()->only(['meta_title', 'meta_description']);

			$meta = array_filter($meta);

			if($meta) {

				$model->seo()->updateOrCreate(['model_id' => $model->getId()], $meta);
			}
		}

		if($model->hasMultilanguage()){

			if(request()->has('translations')){

				$language = request()->get('translations');

				foreach(Arr::get(request()->all(), $language) ?? [] as $key => $value){

					if(!$value){

						$query = $model->getModelQuery($key);

						if($query){

							$query->delete();
						}

					} else {

						\Lang::updateOrCreate(['model_type' => $model->getMorphClass(), 'model_id' => $model->getId(), 'field' => $key, 'lang' =>  $language, 'model_post_type' => $model->getMorphClass() == 'article' ? $model->getPostType() : null], ['text' => $value]);
					}
				}
			}
		}


		if(!$model->hasMultilanguage() || ($model->hasMultilanguage() && !request()->has('translations'))) {

			$fillable = $model->getFillable();

			$request = request()->request->all();

			$properties = array_filter( array_diff_key( $request, array_flip( $fillable ) ), function ( $value, $key ) use ($model) {

				return (!method_exists($model, $key)) && !in_array( $key, [ 'link', 'action', 'data', 'role', 'permission', 'reset-password', 'token' ] ) && ! Str::startsWith( $key, [ '_', 'meta_' ] ) /*&& !is_array($value)*/ && !($value instanceof UploadedFile);

			}, ARRAY_FILTER_USE_BOTH );

			if ($properties) {

				foreach ( $properties as $property => $value ) {


					if(is_array($value)) {

						$groups = $value;

						$repeaterField = $model->properties()->updateOrCreate( [
							'model_id' => $model->getId(),
							'property' => $property,
							'type' => 'repeater'
						]);

						foreach($groups as $key => $group){

							$groupField = \Property::updateOrCreate([
								'model_id' => $repeaterField->getId(),
								'model_type'=> 'property',
								'property' => $property.'_'.$key,
								'type' => 'group'
							], [ 'value' => null ] );


							foreach($group as $field => $value){

								\Property::updateOrCreate( [
									'model_id' => $groupField->getId(),
									'model_type'=> 'property',
									'property' => $field,
								], [
									'value' => $value,
									'type' => $this->getFieldType($value)
								] );

							}
						}

					} else {

						if(property_exists($model, 'properties')){

							$model->properties()->updateOrCreate( [
								'model_id' => $model->getId(),
								'property' => $property,
							], [
								'value' => $value,
								'type' => $this->getFieldType($value)
							] );
						}

					}
				}
			}
		}
	}

	private function saveSeo(){

	}

	private function getFieldType($value){

		if($value instanceof Collection){

			$type = 'collection';

		} elseif(is_array($value)){

			$type = 'array';

		} elseif(is_string($value) && is_array(json_decode($value, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false){

			$type = 'json';

		} elseif(is_object($value)){

			$type = 'object';

		} elseif(is_numeric( $value ) && floor( $value ) != $value){

			$type = 'decimal';

		} elseif(is_int( $value )){

			$type = 'integer';

		} elseif(\DateTime::createFromFormat('Y-m-d H:i:s', $value) !== FALSE){

			$type = 'datetime';

		} elseif(\DateTime::createFromFormat('Y-m-d', $value) !== FALSE){

			$type = 'date';

		} else {

			$type = 'string';
		}

		// 'bool',
		//
		// 'media'

		return $type;
	}

    /**
     * Handle the model "created" event.
     *
     * @param  $model
     * @return void
     */

    public function creating($model) {

	    if(Schema::hasColumn($model->getTable(), 'user_id')) {

		    $userId = null;

		    if(request('user_id')){

			    $userId = request('user_id');

		    } elseif(auth()->guard('administrator')->check()){

			    $userId = auth()->guard('administrator')->user()->getId();

		    } elseif(auth()->check()){

			    $userId = auth()->user()->getId();
		    }

		    $model->user_id = $userId;
	    }

	    if(Schema::hasColumn($model->getTable(), 'author_id')) {

		    $authorId = null;

		    if(auth()->guard('administrator')->check()){

			    $authorId = auth()->user()->getId();
		    }

		    $model->author_id = $authorId;
	    }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param $model
     * @return void
     */

    public function updating($model) {

	    if(Schema::hasColumns($model->getTable(), ['published', 'published_at'])) {

		    if($model->isDirty('published')){

		    	if($model->published){

				    //$model->published_at = Carbon::now();

					$model->published_by = auth()->user()->getId();

			    } else {

				    //$model->published_at = $model->published_by = null;
			    }
		    }
	    }
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
