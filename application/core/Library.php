<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

/** 
 * Library of global functions - core
 */

/** 
 * Function to load classes. The call is equivalent to "$class = new ClassName()";
 * If the class has already been instantiated, use that.
 * Parameters:
 * - class name
 * - directory of class (default is 'libraries')
 * - some object (DAO uses 'PDO' type to connect with database)
 */
if (!function_exists('loadClass')) {
    function &loadClass($class, $dir = 'libraries', $obj = null) {
        static $_classes = array();

        // Check the class if already been instantiated, then use the same object.
        // e.g. Useful to call the same class on various places and also forget whether it has already been instantiated before
        if (isset($_classes[$class])) {
        	// echo " *CARREGADO![".$class."]* "; // debug
            return $_classes[$class];
        }

        $name = FALSE; // initializes default status = false
        // Check if file exists
        if (file_exists(APPPATH . $dir . '/' . $class . '.php')) {
            $name = $class;
            // Check if the class has been defined
            if (class_exists($name) === FALSE) {
                require(APPPATH . $dir . '/' . $class . '.php'); // if the class has not yet been set, load it now
            }
        }

        // If that class not exists... perhaps something really wrong is going on here
        if ($name === FALSE) {
            die('Não foi possível localizar a classe especificada: ' . $class . '.php');
        }

        /*
          // debug
          echo "<pre>";
          print_r ( get_declared_classes() );
          echo "</pre>";
        */
        // echo "EXECUTANDO!![".$class."]... "; // debug
        
        // Keep track of what we just loaded
        is_loaded($class);
        
        // If object has been instantiated, instantiate a new class passing this object at the constructor.
        if($obj !== null) {
        	$_classes[$class] = new $name($obj); // constructor with custom object...
        	return $_classes[$class];
        }
        
        $_classes[$class] = new $name();
        return $_classes[$class];
    }
}

/** 
 * Keeps track of which libraries have been loaded. 
 * This function is called by the loadClass() function above
 * Parameter:
 * - class name
 */
if (!function_exists('is_loaded')){
    function &is_loaded($class = ''){
        static $_is_loaded = array();
        if ($class != '') {
            $_is_loaded[strtolower($class)] = $class;
        }
        return $_is_loaded;
    }
}

/**
 * Function to debug and show the last action of the script
 */
if (!function_exists('last_action')) {
    function last_action() {
        $debug = debug_backtrace();
        if(isset($debug[1])) {
            echo '<p>Última ação executada' ,
                    (isset($debug[1]['function'])?  ' na função ['.$debug[1]['function'].']' :'') ,
                    (isset($debug[1]['class'])?     ' na classe ['.$debug[1]['class'].']'    :'') ,
                    (isset($debug[1]['file'])?      ' no arquivo ['.$debug[1]['file'].']'    :'') , 
                    (isset($debug[1]['line'])?      ' na linha ['.$debug[1]['line'].']'      :'') , '.</p>';
        }
    }
}

/** 
 * Funtion to show custom errors and finish the script
 * Parameters:
 * - message
 * - error code HTTP
 * - title, if you want to customize it
 * - template file
 */
if (!function_exists('show_error')) {
    function show_error($message, $status_code = 500, $heading = 'Ops, um erro foi encontrado!', $error_page = 'error_500') {
        $_error = loadClass('Errors', 'core');
        echo $_error->show_error($message, $status_code, $heading, $error_page);
        exit;
    }
}

/** 
 * Funtion to show the 404 errors code and finish the script
 * Parameters:
 * - message
 * - title, if you want to custom
 */
if (!function_exists('show_404')) {
    function show_404($message, $heading = 'Página não encontrada!') {
        $_error = loadClass('Errors', 'core');
        $_error->show_404($message, $heading);
    }
}

/** 
 * Function to return the name of current class
 */
if (!function_exists('getClass')) {
    function getClass() {
        $tmp = loadClass('Router', 'core');
        return $tmp->getClass();
    }
}

/** 
 * Function to return the name of current method of that class
 */
if (!function_exists('getMethod')) {
    function getMethod() {
        $tmp = loadClass('Router', 'core');
        return $tmp->getMethod();
    }
}

/** 
 * Function to load a library like a object
 */
if (!function_exists('library')) {
	function library($file) {
		return loadClass($file);
	}
}

/** 
 * Function to load a model like a object
 */
if (!function_exists('model')) {
	function model($file, $obj=null) {
		$suffix = substr(strtolower($file) , -3);
		if($suffix == 'dao' && $obj === null) { // verifica se a model carregada é um Data Access Object
			// usa a conexão com o BD sempre que algum model DAO for chamado
			$db_obj = loadClass('PDOConnectionFactory', 'database'); // instancia um objeto de PDOConnectionFactory
			if(is_object($db_obj->connection)) {
				return loadClass($file, 'models/dao', $db_obj->connection); // verifica se já possui uma conexão aberta e a utiliza
			}
			return loadClass($file, 'models/dao', $db_obj->getConnection()); // carrega DAO com nova conexão
		}
		return loadClass($file, 'models', $obj); // carrega uma model comum utilizando um objeto customizado, se disponível
	}
}

/** 
 * Function to include parts of a layout, usually in the 'views' folder
 * Parameters:
 * - name/full path to the file of view folder
 * - array variables
 */
if (!function_exists('view')) {
    function view($path, $vars=array()) {
        $tmp = loadClass('View', 'core');
        try {
        	echo $tmp->load($path, $vars);
        } catch(InvalidViewException $e) {
        	die($e->getMessage());
        }
    }
}

