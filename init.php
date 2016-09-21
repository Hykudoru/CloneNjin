<?php
/*
* CloneNjin
*
* An MVC server-side PHP template cloning system.
*
* MIT License
*
* Copyright (c) 2016 Alexander Miles Fish
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*/

/*
* The init file should be included in all views!
* Performs all required system initializing.
* Defines path constants, requires core files,
* and determines which controller and method to
* to use for rendering the view. */

if (!defined('DS')) 			{ define('DS', 				DIRECTORY_SEPARATOR); }
if (!defined('ROOT')) 			{ define('ROOT', 			dirname(__FILE__)); }
if (!defined('SYSTEM'))			{ define('SYSTEM'			ROOT.DS.'system'); }
if (!defined('CORE')) 			{ define('CORE' 			SYSTEM.DS.'core'); }
if (!defined('APPLICATION')) 	{ define('APPLICATION' 		ROOT.DS.'application'); }
if (!defined('CONTROLLERS'))	{ define('CONTROLLERS'  	APPLICATION.DS.'controllers'); }
if (!defined('MODELS')) 		{ define('MODELS' 			APPLICATION.DS.'models'); }
if (!defined('VIEWS')) 			{ define('VIEWS'			APPLICATION.DS.'views'); }

if (!defined('PAGE_PARENT')) 	{ define('PAGE_PARENT', 	basename(pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME))); }
if (!defined('PAGE')) 			{ define('PAGE', 			pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)); }

require_once(APPLICATION.DS.'config.php');
require_once(CORE.DS.'ObjectLoader.php');
require_once(CORE.DS.'CloneNjin.php');


/**
* The chosen class and method is determined at run time.
* The controller loaded corresponds to the current parent 
* directory name of the current page. Its method 
* chosen to be called corresponds to the current page name.
* The ObjectLoader class returns the object controller and 
* calls the chosen method, which renders the view. */

$class = PAGE_PARENT;
$method = PAGE;
		
try {
	$controller = ObjectLoader::controller($class);
	if(method_exists($controller, $method)) {
		$controller->$method();
	} else {
		die("CloneNjin Error: '{$class}' must implement method '{$method}()'!");
	}
}catch (Exception $e) {
	die($e->getMessage());
}final {
	unset($class);
	unset($method);
}