<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Parser;

class View_Dwoo extends \View {

	protected static $_parser;

	protected static function capture($view_filename, array $view_data)
	{
		$data = static::$_global_data;
		$data = array_merge($data, $view_data);

		try
		{
			return static::parser()->get($view_filename, $data);
		}
		catch (\Exception $e)
		{
			// Delete the output buffer
			ob_end_clean();

			// Re-throw the exception
			throw $e;
		}
	}

	public $extension = 'tpl';

	public function parser()
	{
		if ( ! empty(static::$_parser))
		{
			return static::$_parser;
		}

		static::$_parser = new \Dwoo();

		return static::$_parser;
	}
}

// end of file dwoo.php