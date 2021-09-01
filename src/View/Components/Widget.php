<?php

namespace wh1110000\CmsL8\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use ReflectionProperty;
use ReflectionObject;

/**
 * Class Widget
 * @package Workhouse\Components\View
 */

class Widget extends Component {

	private $view;

	private $instance;

	private $block;

	private $namespace = 'App\View\Blocks\\';

	protected $fields = [

	];

	protected $translatable = [

	];

	/**
	 * @var string
	 */

	public $name;

	/**
	 * @var bool
	 */

	public $show;

	/**
	 * Widget constructor.
	 *
	 * @param string $name
	 * @param null $id
	 * @param bool $show
	 * @param array $properties
	 */

	public function __construct($name) {

		$this->name = $name;

		$this->id = '';

		$this->view = Str::studly($this->name);

		$this->instance = $this->namespace.$this->view;

		if(!class_exists($this->instance)){

			return new \Exception('Widget Class ['.$this->instance.'] Not Exists');
		}

		$this->fields = $this->instance::$fields;

		$this->translatable = $this->instance::$translatable;

		$this->block =

		dd($this->fields);

		/*foreach($properties as $key => $value){

			$this->{$key} = $value;
		}


		$this->show = $show;*/
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */

    public function render() {

        return view('widget::'.$this->name);
    }

	/**
	 * @return array
	 */

	protected function extractPublicProperties() {

		$class = get_class($this);

		if (! isset(static::$propertyCache[$class])) {

			$reflection = new ReflectionObject($this);

			static::$propertyCache[$class] = collect($reflection->getProperties(ReflectionProperty::IS_PUBLIC))
				->reject(function (ReflectionProperty $property) {
					return $this->shouldIgnore($property->getName());
				})
				->map(function (ReflectionProperty $property) {
					return $property->getName();
				})->all();
		}

		$values = [];

		foreach (static::$propertyCache[$class] as $property) {

			$values[$property] = $this->{$property} ?? null;
		}

		return $values;
	}
}
