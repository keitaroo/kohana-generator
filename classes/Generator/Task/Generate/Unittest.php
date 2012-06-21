<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Task for generating unit test cases, see Task_Generate_Unittest for usage.
 *
 * @package    Generator 
 * @category   Generator/Tasks 
 * @author     Zeebee 
 * @copyright  (c) 2012 Zeebee 
 * @license    BSD revised 
 */
class Generator_Task_Generate_Unittest extends Task_Generate
{
	/**
	 * @var  array  The task options
	 */
	protected $_options = array(
		'name'   => '',
		'groups' => '',
		'extend' => '',
		'blank'  => FALSE,
	);

	/**
	 * Validates the task options.
	 *
	 * @param  Validation  $validation  the validation object to add rules to	 
	 * @return Validation
	 */
	public function build_validation(Validation $validation)
	{
		return parent::build_validation($validation)
			->rule('name', 'not_empty');
	}

	/**
	 * Loads any view parameter defaults from config.
	 *
	 * @return array
	 */
	public function get_defaults()
	{
		if ($defaults = Kohana::$config->load('generator.defaults.class'))
			return $defaults;

		return array();
	}

	/**
	 * Creates a generator builder with the given configuration options.
	 *
	 * @param  array  $options  the selected task options
	 * @return Generator_Builder
	 */
	public function get_builder(array $options)
	{
		return Generator::build()
			->add_unittest($options['name'])
				->group($options['groups'])
				->extend($options['extend'])
				->blank($options['blank'])
				->module($options['module'])
				->template($options['template'])
				->pretend($options['pretend'])
				->force($options['force'])
			->with_defaults($this->get_defaults())
			->prepare();
	}

	/**
	 * Executes the task.
	 *
	 * @param  array  $params  the task parameters
	 * @return void
	 */
	protected function _execute(array $params)
	{
		$builder = $this->get_builder($params);
		$this->run($builder, $params);
	}

} // End Generator_Task_Generate_Unittest 