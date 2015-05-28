<?
/**
 * Helper class containing useful static functions
 *
 */
class Helper {
	/**
	 * debug function.
	 * 
	 * @access public
	 * @static
	 * @param string $variable (default: '_NOT_SET_')
	 * @return void
	 */
	public static function debug($variable = '_NOT_SET_') {
		// don't show forgotten debugs in production, just abort the function silently
		if (Config::get('app.env') == 'production') return;
		
		echo '<!DOCTYPE html><html><head><title>Debug</title><style>.debug{margin:2rem;background:#eee;border:1px solid #F27456;border-radius:3px;box-shadow:0 1px 5px rgba(0,0,0,.1)}.debug>h1,.debug>h2{margin:0;padding:.5rem;font-family:sans-serif;font-weight:normal;text-shadow:1px 1px 1px rgba(0,0,0,.1);}.debug>h1{font-size:1.5rem;border-bottom:1px solid rgba(0,0,0,.05);background:#F27456;color:#fff;text-align:center;}.debug>h2{margin-left:.5rem;font-size:1.2rem;color:rgba(0,0,0,.5)}.debug>pre{margin:0 1rem 1rem;padding:.5rem;background:rgba(0,0,0,.05);border-radius:3px;font-size:1.1rem}</style></head><body>';
		echo '<div class="debug"><h1>Debug: ' . substr(debug_backtrace()[0]['file'], strlen(PATH)) . ', Zeile ' . debug_backtrace()[0]['line'] . '</h1>';
		if ($variable !== '_NOT_SET_') {
			echo '<h2>Wert der Variable:</h2><pre>';
				var_dump($variable);
			echo '</pre>';
		}
		echo '<h2>Stacktrace:</h2><pre>';
			print_r(debug_backtrace()[0]);
		echo '</pre></div></body></html>';
		exit();
	}
}