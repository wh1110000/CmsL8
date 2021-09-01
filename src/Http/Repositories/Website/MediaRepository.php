<?php

namespace wh1110000\CmsL8\Http\Repositories\Website;

use Illuminate\Support\Facades\Storage;
use wh1110000\CmsL8\Http\Repositories\WebRepository;

/**
 * Class MediaRepository
 * @package Workhouse\Media\Repositories\Website
 */

class MediaRepository extends WebRepository {

	/**
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function archivePage( $render = true ) {

		$data = $this->model->orderBy('created_at', 'DESC')->paginate(12);
		$this->setView('index');
		return $render ? $this->view(compact( 'data')) : $data;
	}

	/**
	 * @param $slug
	 * @param null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function destroy( $slug, $closure = null ) {

		return parent::destroy($slug, function() {

			if($status = $this->model->delete()){

				if($status = \Property::where('type', 'media')->where('value', $this->model->getId())->update(['value' => null])){

					Storage::disk('public')->delete('img/'.$this->model->getFilename());
				}
			}

			return $status;

		});
	}

	/**
	 * @param $filename
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
	 */

	public static function download($filename){

		$file = self::where('filename', $filename)->first();

		if($file) {

			$path = storage_path("app/public/files/" . $file->getFilename());

			return Response()->download($path, $file->getFilename());
		}

		return redirect()->back();
	}
}