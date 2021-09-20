<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

use Illuminate\Http\Request;
use wh1110000\CmsL8\Models\Presenters\Nav;
use wh1110000\CmsL8\Models\Presenters\NavPage;
use wh1110000\CmsL8\Http\Requests\Admin\Modal\NavRequest;
use wh1110000\CmsL8\Http\Requests\Admin\Modal\PageRequest;

/**
 * Class NavController
 * @package Workhouse\Pages\Controllers\Admin
 */

class NavController extends Controller {

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
	 */

	public function index(){

		$navs = \Nav::get();

		$nav = $this->repository->model;

		return $this->repository->view(compact( 'nav', 'navs'));
	}

	/**
	 * @param NavRequest $request
	 * @param nav $nav
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showNavModal(NavRequest $request, Nav $nav){

		$result = false;

		if($request->action == 'add'){

			try {

				$result = $nav->fill($request->all())->save();

			} catch (\Exception $e) {

				report($e);
			}
		}

		return view('admin.nav::modal.navShow', compact('nav', 'result'));
	}

	/**
	 * @param Nav $nav
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */

	public function destroyNav(Nav $nav) {

		\DB::beginTransaction();

		try {

			$nav->pages()->delete();

			if($nav->delete()){

				\DB::commit();

				return response()->json(["success" => true, 'redirect' => route('admin.nav.index')]);
			}

		} catch ( \Exception $e ) {

			report($e);
		}

		\DB::rollback();

		return response()->json(["success" => false]);
	}

	/**
	 * @param PageRequest $request
	 * @param Nav $nav
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function addToNavModal(PageRequest $request, Nav $nav) {

		$result = false;

		if($request->action == 'add'){

			try {

				if($request->data) {

					foreach ( explode( ',', $request->data ) as $page ) {

						$nav->pages()->save( new NavPage( [
							'content_id' => is_numeric( $page ) ? $page : null,
							'nav_order' => $nav->pages()->max( 'nav_order' ) + 1,
							'type'       => ! is_numeric( $page ) ? $page : null
						] ) );
					}
				}

				$result = true;

			} catch (\Exception $e) {

				report($e);
			}
		}

		$pages = \Page::get();

		$contents['data'] = $pages->map(function ($content, $index) {

			$content['index'] = $index + 1;

			$content['page'] = in_array($content->getType(), ['internal', 'external']) ? $content->getId() : $content->getLink();

			return $content->only(['index', 'page', 'title']);
		});

		return view('admin.nav::modal.addPage', compact('result', 'contents', 'nav'));
	}

	/**
	 * @param NavRequest $request
	 * @param NavPage $page
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showPageModal(NavRequest $request, NavPage $page){

		$result = false;

		if($request->action == 'add'){

			try {

				$result = $page->fill($request->all())->save();

			} catch (\Exception $e) {

				report($e);
			}
		}

		return view('admin.nav::modal.editPage', compact('page', 'result'));
	}

	/**
	 * @param Request $request
	 * @param Nav $nav
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */

	public function reorderPages(Request $request, Nav $nav){

		\DB::beginTransaction();

		try {

			$order = 1;

			foreach($request->data as $page){

				NavPage::where('id', $page)->update([
					'nav_id' => $nav->getId(),
					'nav_order' => $order++,
				]);
			}

			\DB::commit();

			return response()->json(["success" => true]);

		} catch ( \Exception $e ) {

			report($e);
		}

		\DB::rollback();

		return response()->json(["success" => false]);
	}

	/**
	 * @param NavPage $page
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */

	public function destroyPage(NavPage $page) {

		try {

			if($page->delete()){

				return response()->json(["success" => true]);
			}

		} catch ( \Exception $e ) {

			report($e);
		}

		return response()->json(["success" => false]);
	}
}