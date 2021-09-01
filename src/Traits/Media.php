<?php

namespace wh1110000\CmsL8\Traits;

trait Media {
	/**
	 * @param $imageKey
	 * @param bool $showThumbnailIfEmpty
	 * @param null $defaultImage
	 *
	 * @return null|string
	 */

	public function getImage($imageKey, $showThumbnailIfEmpty = true, $defaultImage = null){



		if(isset($this->{$imageKey})){

			//$file = $this->getMedia($imageKey);

			return $this->{$imageKey}->getFile();
			/*if($file){

				return $file->getFile();
			}*/
		}

		if($showThumbnailIfEmpty == true) {

			if($defaultImage){

				return asset( 'images/'.$defaultImage );

			} else {

				return asset( 'images/noimage.jpg' );
			}
		}

		return null;
	}

	/**
	 * @param $imageKey
	 *
	 * @return bool
	 */

	public function hasImage($imageKey){

		if(isset($this->{$imageKey})){

			//$media = $this->getMedia($imageKey);

			if($this->{$imageKey}->fileExists()){

				return true;
			}
		}

		return false;
	}

	/**
	 * @param $imageKey
	 *
	 * @return \Illuminate\Support\Collection
	 */

	public function getGallery($imageKey){

		$images = collect();

		if(isset($this->{$imageKey})){

			$gallery = $this->{$imageKey};

			$images = \Media::whereIn('id', is_array($gallery) ? $gallery : [$gallery])->get();
		}

		return $images;
	}

	/**
	 * @param $imageKey
	 *
	 * @return null|string
	 */

	public function getImagePath($imageKey){

		if(isset($this->{$imageKey})){

			if(!is_null($this->{$imageKey}) && Storage::disk('public')->exists($this->imgFolder.'/'.$this->{$imageKey})){

				return storage_path('app/public/'.$this->imgFolder.'/'.$this->{$imageKey});
			}
		}

		return null;
	}

	/**
	 * @param $key
	 *
	 * @return Model|null|object|static
	 */

	public function getMedia($key){

		return app('MediaLibrary')->where('id', $this->$key)->first();

		return $this->media($key)->first();
	}

	public function getFile2($filename){

		$mediaId = optional($this->properties->where('type', 'media')->where('property', $filename)->first())->value;

		if($mediaId){

			return app('MediaLibrary')->where('id', $mediaId)->first();
		}

		return $mediaId;
	}

	/**
	 * @param $imageKey
	 *
	 * @return null|string
	 */

	public function isImage($imageKey){

		return $this->getImage($imageKey, false);
	}


	/**
	 * @return HasOne
	 */

	public function media($key){

		return $this->hasOne('\Media', 'id', $key);
	}

	public function mediaFileTest(){

		//if($this->type == 'media'){

		return $this->hasOne('\Media', 'id', 'value');
		//}

	}
}
