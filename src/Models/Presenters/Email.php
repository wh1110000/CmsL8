<?php

namespace wh1110000\CmsL8\Models\Presenters;

use wh1110000\CmsL8\Models\Email as BaseModel;

/**
 * Class Email
 * @package Workhouse\Contact\Presenters
 */

class Email extends BaseModel {

	/**
	 * @return mixed
	 */

	public function form() {

		$row = \Row::init()
			->addCol(12)
			->addSection()
			->addField([
				\Fields::text('first_name', __('core::fields.first_name') )->add(),
				\Fields::text('last_name', __('core::fields.last_name'))->add()
			])
			->addField(\Fields::email('email', __('core::fields.email'))->add())
			->addField(\Fields::phone('phone', __('core::fields.phone'))->add())
			->addField(\Fields::textarea('enquiry',  __('core::fields.enquiry'))->add());

		return $row;
	}

	/**
	 * @return mixed
	 */

	public function dataTable($route) {

		$query = $this;

		$type = request('type') ?? 'inbox';

		$tag = request('tag');

		if($tag){

			$query = $query->whereHas('tags', function ($query) use ($tag) {

				$query->where('link', request('tag'));
			});
		}

		if(in_array($type, ['inbox', 'sent', 'drafts', 'trash','important'])){

			switch ($type){
				case 'important':

					$query = $query->where('important', true);

					break;

				case 'trash':

					$query = $query->onlyTrashed();

					break;

				default:

					$query = $query->where('type', $type);
			}
		}

		return \DataTable::of($query)
             ->setRoute(route($route.'index', ['type' => $type]))
             ->setColumns([
                 'email' => [
	                 'title' => __('core::fields.email'),
	                 'width' => 20,
	                 'filter' => [
		                 'type' => 'text',
	                 ],
                 ],
                 'subject' => [
	                 'title' => __('core::fields.subject'),
	                 'width' => 20,
	                 'filter' => [
		                 'type' => 'text',
	                 ],
                 ],
             ])
			->editColumn('email', function($email){

				return implode('<br />', [$email->getFullName(), '<span class="text-muted">'.$email->getEmail().'</span>']);
			})
			->editColumn('subject', function($email){

				return implode('<br />', [$email->getSubject(), '<span class="text-muted">'.$email->getEnquiry(100).'</span>']);
			})
             ->setActionButtons(function($email) use ($route, $type) {

                 return [
	                 \Button::show([$route.'show', 'type' => $type, $email]),
	                 \Button::delete([$route.'destroy', 'type' => $type, $email])
                 ];
             })
             ->make()
             ->response();
	}
}