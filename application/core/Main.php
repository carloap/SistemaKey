<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

/* --------------------------------------------------------------------
 * Main - initialize the functions and class needed
 * --------------------------------------------------------------------
 */
// Sets the charset to the characters shown in the screen
header('Content-Type:text/html; charset=utf-8');

// Load the Global Functions needed
require(APPPATH . 'core/Library.php');

// Load and Instantiate the Configuration Class
$core['CFG'] = loadClass('Config', 'core');

// Load and Instantiate the URI Class
$core['URI'] = loadClass('URI', 'core');
$core['URI']->detect_uri(); // read and translate URL

// Load and Instantiate the Router Class
$core['RTR'] = loadClass('Router', 'core');
$core['RTR']->setRoute(); // This sets an initial route

// Load and Instantiate the security and encryption Class
$core['SEC'] = loadClass('Security', 'core');

// Catch current url
$directory  = $core['RTR']->getDirectory();
$class      = $core['RTR']->getClass(); // catch the current class name - the controller class
$method     = $core['RTR']->getMethod(); // catch the current method name of this class

// If no class has been defined, then go to the default class!
if (empty($class)) {
    $class = $core['CFG']->getDefaultController(); // retorna o valor contido em 'default_controller' (a controller padrão, no arquivo config)
}

// If this class does not exists, finish showing an error!
if (!file_exists(APPPATH . 'controllers/' . $directory . $class . '.php')) {
    show_404('A página que você está tentando acessar não foi encontrada.');
}

// Load the current controller
include(APPPATH . 'controllers/' . $directory . $class . '.php');

// Instantiate the requested controller
$Ctrl = new $class();

// Call the method of this controller - current
if (!method_exists($Ctrl, $method)) {
    // If the method does not exists, finish showing an error!
    show_404('A página que você está tentando acessar não foi encontrada.');
    //show_error('A página que você está procurando não existe.', 404); 
}

// Call the method on instantiated object, going on to another part of the URL as a parameter
call_user_func_array(array($Ctrl, $method), array_slice($core['RTR']->getSegments(), $core['RTR']->getJumpSegment()));


// End of file