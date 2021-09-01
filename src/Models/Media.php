<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Support\Str;

/**
 * Class Media
 * @package Workhouse\Media\Models
 */

class Media extends BaseModel {

	/**
	 * @var array
	 */

	protected $fillable = [
		'filename',
		'alt',
		'size',
		'width',
		'height',
		'mime_type'
	];

	/**
	 * @var bool
	 */

	protected $hasSeo = false;

	/**
	 * @return string
	 */

	public function getFile(){

		if($file = $this->fileExists()){

			return $file;
		}

		return \Html::placeholder();
	}

	/**
	 * @return string
	 */

	public function getFilePlaceholder(){

		if($file = $this->fileExists()){

			if(Str::startsWith($this->getMime(), 'image/')){

				return $file;

			} elseif(Str::startsWith($this->getMime(), 'video/')){

				return $file;

			} else {

				if(Str::endsWith($this->getMime(), 'pdf')) {

					return 'https://lh3.googleusercontent.com/W1Jwfw3dKIo8BsQFaLc0y4UflpgSUlDKiWn4LgjKXFW1Uxj1t8qfwYu987CnBDWdsENT=s180-rw';
				}
			}
		}

		return \Html::placeholder();
	}

	/**
	 * @return bool|string
	 */

	public function fileExists(){

		$file = public_path('storage/img/'.$this->getFilename());

		if(file_exists($file)){

			return asset('storage/img/'.$this->getFilename());
		}

		return false;
	}

	/**
	 * @return mixed
	 */

	public function getFilename(){

		return $this->filename;
	}

	/**
	 * @return mixed
	 */

	public function getAlt(){

		return $this->alt;
	}

	/**
	 * @return string
	 */

	public function getSize(){

		$size = formatSizeUnits($this->size);

		return $size['number']. ' '. $size['unit'];
	}

	/**
	 * @return string
	 */

	public function getDimensions($type = null){

		switch ($type){

			case 'width':

				return $this->width;

			case 'height':

				return $this->height;

			default:

				$dimensions = [];

				if($this->width){

					$dimensions[] = 'w: '. $this->width .'px';
				}
				if($this->width && $this->height){

					$dimensions[] = 'h: '. $this->height .'px';
				}

				return implode(' x ', $dimensions);
		}

		return null;
	}

	/**
	 * @return mixed
	 */

	public function getMime(){

		return $this->mime_type;
	}
}