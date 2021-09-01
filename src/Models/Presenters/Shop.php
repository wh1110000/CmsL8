<?php

namespace wh1110000\CmsL8\Models\Presenters;

use wh1110000\CmsL8\Traits\Address;
use wh1110000\CmsL8\Traits\Contact;
use wh1110000\CmsL8\Models\Shop as BaseModel;

/**
 * Class Shop
 * @package Workhouse\Shops\Presenters
 */

class Shop extends BaseModel {

	use Contact, Address;

	/**
	 * @var array
	 */

	protected $translatable = [
		'name',
		'short_description',
		'description',
	];

	/**
	 * @return array
	 */

	public function getNameLocation() {

		return implode(',', [
			$this->name,
			$this->county
		]);
	}


	/**
	 * @return mixed
	 */

	public function getManagerName(){

		return $this->manager_name;
	}

	/**
	 * @return mixed
	 */

	public function dataTable() {

		return \DataTable::of($this->query())
			->setRoute('admin.shop.index')
			->setColumns([
			   'name' => [
			       'title' => __('cms::general.name'),
			       'width' => 85,
			       'filter' => [
			           'type' => 'text',
			       ],
			   ],
			])
			->setActionButtons(function($shop){

			   return [
			       \Button::edit(['admin.shop.show', $shop]),
			       \Button::delete(['admin.shop.destroy', $shop])
			   ];
			})
			->make()
			->response();
	}

	/**
	 * @return array
	 */

	public function contentTab() {

		$categories = '';

		foreach (\ShopCategory::get() as $category){

			$categories .= '
				
				<div class="custom-control custom-radio">
				  <input type="radio" id="shop_category_id_'.$category->getId().'" value="'.$category->getId().'" name="shop_category_id" class="custom-control-input" ' . ( !empty(old('category')) && in_array($category->getId(), old('category')) ? 'checked' : "" /*(($post->hasCategory($category) ? 'checked' : '')*/ ).' >
				  <label class="custom-control-label" for="shop_category_id_'.$category->getId().'">' . $category->getTitle() .'</label>
				</div><hr />
             ';
		}

		return \Row::init()
			->addCol(6)
			->addSection(__('cms::general.main_details'))
			->addField(\Fields::text('name')->add())
			->addField(\Fields::phone('phone')->add())
			->addField(\Fields::email('email')->add())
			->addField(\Fields::editor('short_description')->add())
			->addField(\Fields::editor('description')->add())
			->addCol(6)
			->addSection(__('cms::general.address'))
			->addField(\Fields::text('street')->add())
			->addField(\Fields::text('street_extra')->add())
			->addField([
			    \Fields::text('postcode')->add(),
			    \Fields::text('city')->add()
			])
			->addField(\Fields::text('county')->add())
			->addField(\Fields::select('country_id')->values(\Country::pluck('label', 'id')->prepend('', ''))->selected($this->country_id)->add())
			->addSection(__('cms::general.department'))
			->addField(\Fields::bool('department')->add())
			->addSection(__('cms::general.categories'))
			->addField($categories);

	}

	/*public function openingHoursTab(){

		return \Row::init()
		           ->addCol(6)
		           ->addSection(__('cms::general.main_details'))
		           ->addField(view('admin.shop::tabs.opening_hours')->with('post', $this)->render());

	}*/

	/*public function testimonialsTab(){

		if(class_exists(\Testimonial::class)){

			$testimonials = new \Testimonial;

			$testimonials = $testimonials->dataTable();

			return \Row::init()
			           ->addCol(6)
			           ->addSection(__('cms::general.main_details'))
			           ->addField(view('admin.shop::tabs.testimonials')->with('testimonials', $testimonials)->render());
		}


	}*/
}
