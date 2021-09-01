<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\SitemapGenerator;

/**
 * Class SitemapController
 * @package Workhouse\Cms\Controllers\Admin
 */

class SitemapController extends Controller {

	public function sitemap(){

		//$sitemap = Sitemap::create()
		//	->add(Url::create('/en'));

		/*NewsItem::all()->each(function (NewsItem $newsItem) use ($sitemap) {
			$sitemap->add(Url::create("/news/{$newsItem->slug}"));
		});

		Projects::all()->each(function (Project $project) use ($sitemap) {
			$sitemap->add(Url::create("/project/{$project->slug}"));
		});*/

		$sitemap = SitemapGenerator::create(url(''));

		$path = public_path('sitemap.xml');

		$sitemap->writeToFile($path);

		return response(file_get_contents($path), 200, [
			'Content-Type' => 'application/xml'
		]);

	}
}