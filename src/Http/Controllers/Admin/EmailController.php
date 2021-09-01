<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

/**
 * Class EmailController
 * @package Workhouse\Contact\Controllers\Admin
 */

class EmailController extends Controller {

	/**
	 * EmailController constructor.
	 */

	public function __construct() {

		$emails = \Email::get();

		$trashed= \Email::onlyTrashed();

		$tags  = \EmailTag::get();

		$counts = [
			'inbox' => $emails->where('type', 'inbox')->count() . (($notRead = $emails->where('type', 'inbox')->where('read', false)->count()) > 0 ? ' (' . $notRead . ')' : ''),
			'important' => $emails->where('important', true)->count(),
			'sent' => $emails->where('type', 'sent')->count(),
			'drafts' => $emails->where('type', 'drafts')->count(),
			'trash' => $trashed->count(),
		];


		\View::share(compact('counts', 'tags'));
	}

	/**
	 * @param $slug
	 *
	 * @return mixed
	 */

	public function show($slug = null) {

		$this->repository->read();

		return parent::show($slug);
	}
}