<?php

namespace wh1110000\CmsL8\View\Components;

use Illuminate\View\Component;

class SocialMedia extends Component {

	/**
	 * @var string
	 */

	public $template;

	/**
	 * @var
	 */

	public $socialMedia;

	/**
	 * @var string
	 */

	public $container = 'ul';

	/**
	 * @var string
	 */

	public $containerClass = '';

	/**
	 * @var string
	 */

	public $list = 'li';

	/**
	 * @var string
	 */

	public $listClass = '';

	/**
     * Create a new component instance.
     *
     * @return void
     */

	public function __construct($template = 'LABEL', $container = null, $containerClass = null, $list = null, $listClass = null) {

	    switch ($template){

		    case 'LABEL':

			    $this->template = 'label';

			    break;

		    case 'ICON':

			    $this->template = 'icon';

			    break;

		    default:

			    $this->template = 'both';
	    }

	    if($container){

	    	$this->container = $container;
	    }

	    if($containerClass){

	    	$this->containerClass = $containerClass;
	    }

	    if($list){

	    	$this->list = $list;
	    }

	    if($listClass){

	    	$this->listClass = $listClass;
	    }

		$this->socialMedia = app('socialMedia')->filter(function ($model){

			return $model->isActive();
		});
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */

    public function render() {

        return view('socialMedia::social-media');
    }
}
