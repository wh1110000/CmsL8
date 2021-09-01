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
				\Fields::text('first_name', __('contact::fields.first_name') )->add(),
				\Fields::text('last_name', __('contact::fields.last_name'))->add()
			])
			->addField(\Fields::email('email', __('contact::fields.email'))->add())
			->addField(\Fields::phone('phone', __('contact::fields.phone'))->add())
			->addField(\Fields::textarea('enquiry',  __('contact::fields.enquiry'))->add());

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
	                 'title' => __('contact::fields.email'),
	                 'width' => 20,
	                 'filter' => [
		                 'type' => 'text',
	                 ],
                 ],
                 'subject' => [
	                 'title' => __('contact::fields.subject'),
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