<?
/**
 * Initialize a new AJAX process and set up the prerequisites
 *
 */
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('PATH', dirname(dirname(dirname(__FILE__))) . DS);

require PATH . 'loader.php';

Loader::load('config');
Config::add(PATH . 'configuration');