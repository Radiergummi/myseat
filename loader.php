<?

class Loader
{
	/**
	 * class name aliases
	 *
	 */
	public static $aliases = array();

	public static $path = '';

	public static function load($name, $path = '') {
		// if we have not yet set the class alias list, populate it now
		if (empty(static::$aliases)) static::$aliases = require(PATH . 'config' . DS . 'aliases.php');

		// set search path to subfolder "classes" if not otherwise specified
		static::$path = (empty($path) ? PATH . 'classes' . DS : $path);

		// allow either a single file or an array to be loaded
		$files = array();
		if (is_array($name)) {
			$files = $name;
		} else {
			$files[] = $name;
		}

		foreach (array_values($files) as $element) {
			static::includeFile($element);
		}
	}
	
	public static function includeFile($name) {
		// find a match after converting indexes and class name to lower case
		if(array_key_exists(strtolower($name), array_change_key_case(static::$aliases))) {
			$filename = static::$aliases[$name];
		}
		
		if (is_readable($file = static::$path . $filename)) require $file;
	}
}