<?php

namespace wh1110000\CmsL8\Http\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class LanguageRepository
 * @package Workhouse\Cms\Admin\Repositories
 */

class LanguageRepository extends AdminRepository {

	/**
	 * @param null $slug
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function singleRecordPage( $slug = null, $render = true ) {

		$post = is_null($slug) ? $this->model : $this->model->resolveRouteBinding($slug);

		$lang = $post->getAlphaCode();

		$model = new \Page;

		request()->query->add(['translations' => $lang]);

		$translatableFields = $model->getTranslatableFields();

		$data = [];

		$allRecords = $model->paginate(10);

		foreach ($allRecords as $record){

			foreach ($translatableFields as $field) {

				$_field = ucwords(specialCharsToSpaces($field));

				$orgTranslation = $record->{'get'.ucwords(str_replace(' ', '', ucwords(specialCharsToSpaces($field))))}();

				$stripTagsTranslation = strip_tags($record->{'get'.ucwords(str_replace(' ', '', ucwords(specialCharsToSpaces($field))))}());

				request()->query->remove('translations');

				$orgValue = strip_tags($record->{'get'.ucwords(str_replace(' ', '', ucwords(specialCharsToSpaces($field))))}());

				if(!$stripTagsTranslation){

					$error = '<span style="color: orange">No translation</span>';

					if(!$orgValue) {

						$error = '<span style="color: red">No translation and default value!</span>';
					}

				} elseif($orgValue == $orgTranslation) {

					$error = '<span style="color: blue">Translated value is the same as default value</span>';

				} else {

					$error = '<span  style="color: green">OK</span>';
				}

				$data[$record->id][] =  $_field . ' = '. $error;

				request()->query->add(['translations' => $lang]);
			}
		}

		$this->model = $post;

		request()->query->remove('translations');

		$this->setView('show');

		return $render ? $this->view(compact( 'post', 'allRecords', 'data')) : $post;
	}
}