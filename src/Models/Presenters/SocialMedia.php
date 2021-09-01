<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class SocialMedia
 * @package Workhouse\SocialMedia\Presenters
 */

class SocialMedia extends \wh1110000\CmsL8\Models\SocialMedia {

	/**
	 * @var array
	 */

	public $translatable = [
		'name',
		'url',
		'active',
	];

	/**
	 * @var bool
	 */

	protected $hasSeo = false;

	/**
	 * @return array
	 */

	public function dataTable() {

		return \DataTable::of($this->query())
			->setRoute('admin.social-media.index')
             ->setColumns([
                 'service' => [
	                 'title' => __('socialMedia::fields.service'),
	                 'width' => 25,
	                 'filter' => [
		                 'type' => 'text',
	                 ],
                 ],
                 'url' => [
	                 'title' => __('socialMedia::fields.url'),
	                 'width' => 25,
	                 'filter' => [
		                 'type' => 'text',
	                 ],
                 ],
                 'name' => [
	                 'title' => __('socialMedia::fields.name'),
	                 'width' => 25,
	                 'filter' => [
		                 'type' => 'text',
	                 ],
                 ]
             ])
             ->setActionButtons(function($socialMedia) {

                 return [
	                 \Button::edit(['admin.social-media.show', $socialMedia]),
	                 \Button::delete(['admin.social-media.show', $socialMedia])
                 ];
             })
             ->make()
             ->response();
	}

	/**
	 * @return array
	 */

	public function contentTab() {

		return \Row::init()
			->addCol(6)
			->addSection(__('cms::general.basic'))
			->addField(\Fields::text('service', __('socialMedia::fields.service'))->add())
			->addField([
				\Fields::text('url', __('socialMedia::fields.url'))->add(),
				\Fields::text('name', __('socialMedia::fields.name'))->add()
			])
			->addField(\Fields::select('active', __('socialMedia::fields.active'))->values([0 => 'No', 1 => 'Yes'])->selected($this->active)->add())
			->addField(\Fields::iconPicker('icon')->add());
	}
}