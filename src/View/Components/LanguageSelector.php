<?php

namespace wh1110000\CmsL8\View\Components;

use Illuminate\View\Component;

/**
 * Class LanguageSelector
 * @package Workhouse\SocialMedia\Components
 */

class LanguageSelector extends Component {

	/**
	 * @var
	 */

	public $languages = [];

	public $currentLanguage;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */

	public function __construct() {

		$currentLocale = app('multilanguage')->getActiveUrlLocale();

		$languages = app('multilanguage')->getAll(/*['ch_de']*/);

		$this->currentLanguage = $languages->where('code', $currentLocale)->first();

		$this->languages = collect();

		if($page = request()->get('currentPage')){

			$languages = $languages->filter(function ($language, $key) use ($currentLocale) {

				return !in_array($language->getCode(), [$currentLocale,  'ch_de']);

			})->map(function ($language) use ($page){

				$lang = $language->getCode();

				switch ($lang){

					case 'ch_fr':

						$language->redirectTo = [
							['label' => 'German', 'slug' => route(\Route::currentRouteName(), ['locale' => 'ch_de', $page->type == 'homepage' ? null : $page->getLink(false, 'ch_de')])],
							['label' => 'France', 'slug' => route(\Route::currentRouteName(), ['locale' => 'ch_fr', $page->type == 'homepage' ? null : $page->getLink(false, 'ch_fr')])]
						];

						break;

					default:

						$language->redirectTo = route(\Route::currentRouteName(), ['locale' => $lang, $page->type == 'homepage' ? null :  $page->getLink(false, $lang)]);

				}

				return $language;
			});

			$this->languages = $languages;


		}
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */

	public function render() {

		return view('languageSelector::language-selector');
	}
}