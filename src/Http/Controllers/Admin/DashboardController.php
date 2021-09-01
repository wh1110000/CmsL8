<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

/**
 * Class DashboardController
 * @package Workhouse\Cms\Controllers\Admin
 */

class DashboardController extends Controller {

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

    public function index() {

    	//return 'dashboard';
    	/*$blocks = $cards = [];

    	foreach(ServiceProvider::getArchives() as $archive){

    		$_archive = \Article::type($archive);

		    $blocks[__($_archive->getPostTypeLabel())] = [
    			__('published') => $_archive->isNotPublished()->count(),
			    __('not_published') => $_archive->published()->count()
		    ];
	    }

	    if(class_exists('Workhouse\Newsletter\Presenters\NewsletterSubscriber')) {

		       $blocks[ __( 'Subscribers' ) ] = [

			    __( 'subscribers' ) => \NewsletterSubscriber::count()
		    ];
	    }

    	$cards[__('Emails')] = [
    		\Email::latest()->limit(10)->get()
	    ];*/

	    //return view('admin.dashboard::index', compact('blocks', 'cards'));
	    return view('admin.dashboard::index');
    }
}