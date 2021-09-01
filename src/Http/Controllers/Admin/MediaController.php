<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

use Illuminate\Http\Request;
use wh1110000\CmsL8\Controllers\Uploader;
use wh1110000\CmsL8\Models\Presenters\Media;
use wh1110000\CmsL8\Requests\Admin\Modal\FileRequest;
use wh1110000\CmsL8\Requests\Admin\Modal\MediaRequest;

/**
 * Class MediaController
 * @package Workhouse\Media\Admin
 */

class MediaController extends Controller {

	/**
	 * @param MediaRequest $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showModal(MediaRequest $request){

		$result = false;

		$files = $this->repository->model->get();

		if($request->action == 'add'){

			view()->share('file', $this->repository->model->where('id', $request->input('file'))->first());

			$result = true;
		}

		return view('admin.media::modal.show', compact('files', 'result'));
	}

	/**
	 * @param MediaRequest $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function uploadModal(MediaRequest $request){

		$result = false;

		if($request->action == 'add'){

			if($request->hasFile('file')){

				$uploader = new Uploader();

				$uploader->hashedName(false)->setFile($request->file('file'));

				if($_file = $uploader->upload()){

					view()->share('file', $this->repository->model->create([
						'filename' => $_file->getFilename(),
						'alt' => null,
						'size' => $_file->getSize(),
						'width' => $_file->getWidth(),
						'height' => $_file->getHeight(),
						'mime_type' => $_file->getMime()
					]));
				}

				$result = true;
			}
		}

		return view('admin.media::modal.upload', $result);
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse|string
	 */

	public function upload(Request $request){

		if($request->hasFile('file')){

			$uploader = new Uploader();

			$uploader->hashedName(false)->setFile($request->file('file'));

			if($_file = $uploader->upload()){

				$file = $this->repository->model->create([
					'filename' => $_file->getFilename(),
					'alt' => null,
					'size' => $_file->getSize(),
					'width' => $_file->getWidth(),
					'height' => $_file->getHeight(),
					'mime_type' => $_file->getMime()
				]);
			}

			return response()->json($file);
		}

		return 'false';
	}

	/**
	 * @param FileRequest $request
	 * @param Media $file
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function editModal(FileRequest $request, Media $file){

		$result = false;

		if($request->action == 'add'){

			$result = $file->fill($request->all())->save();
		}

		return view('admin.media::modal.edit', compact('file', 'result'));
	}

	/**
	 * @param Request $request
	 *
	 * @return array|void
	 */

	public function imageUpload(Request $request){

		if($request->hasFile('file')){

			$uploader = new Uploader();

			$uploader->hashedName(false)->setFile($request->file('file'));

			if($_file = $uploader->upload()){

				$file = \Media::create([
					'filename' => $_file->getFilename(),
					'alt' => null,
					'size' => $_file->getSize(),
					'width' => $_file->getWidth(),
					'height' => $_file->getHeight(),
					'mime_type' => $_file->getMime()
				]);
			}

			return [
				'thumb' => $file->getFile(),
				'url' => $file->getFile(),
				'title' => $file->getFilename(),
				'id' => $file->getId()
			];
		}

		return;
	}

	/**
	 * @return string
	 */

	public function imageManager(){

		$images = [];;

		foreach(\Media::get() as $image){

			$images[] = [
				'thumb' => $image->getFile(),
				'url' => $image->getFile(),
				'title' => $image->getFilename(),
				'id' => 1
			];

		}

		return json_encode($images);
	}
}