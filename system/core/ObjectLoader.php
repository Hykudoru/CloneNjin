<?php/** CloneNjin** An MVC server-side PHP template cloning system.** MIT License** Copyright (c) 2016 Alexander Miles Fish** Permission is hereby granted, free of charge, to any person obtaining a copy* of this software and associated documentation files (the "Software"), to deal* in the Software without restriction, including without limitation the rights* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell* copies of the Software, and to permit persons to whom the Software is* furnished to do so, subject to the following conditions:** The above copyright notice and this permission notice shall be included in all* copies or substantial portions of the Software.** THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE* SOFTWARE.*//*** Responsible for loading models or controllers* and returning new instances.*/
class ObjectLoader
{	/**	*-----------------------------------------------------------	* Loads the class file if needed and returns a new instance.	*-----------------------------------------------------------*/	private static function _load($class, $path)	{		settype($class, "string");		settype($path, "string");		$classType = substr(basename($path), 0, -1);		$file = $path.DS.$class.'.php';		if (!file_exists($file)) {			throw new Exception("CloneNjin Exception: Could not find {$classType} '{$class}'.");		}		if (!class_exists($class)) {			require_once($file);		}		return new $class();	}	/**	*--------------------------------------------------------	* public static object controller(string $controllerName)	*--------------------------------------------------------	* Returns a new model instance.	*	* @param string $controllerName	* @return object	*---------------------------------------------------------*/	public static function controller($controllerName)	{		return self::_load($controllerName, CONTROLLERS);	}	/**	*----------------------------------------------	* public static object model(string $modelName)	*----------------------------------------------	* Returns a new model instance.	*	* @param string $modelName	* @return object	*----------------------------------------------*/
	public static function model($modelName)	{		return self::_load($modelName, MODELS);	}} // End class ObjectLoader