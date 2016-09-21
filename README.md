# CloneNjin
CloneNjin is an MVC server-side template cloning system. The template engine is a key token registering unit and source code processor. I wrote this software for cloning privately constructed alias files to generate dynamic front-end views.

-- OUTSIDE public root --
CloneNjin/application/controllers/Welcome.php
CloneNjin/application/views/Welcome/index.html

-- INSIDE public root --
public/somepath/Welcom/index.php


-- OUTSIDE public root --
CloneNjin/application/controllers/Page.php
CloneNjin/application/views/Page/about.html

-- INSIDE public root --
public/somepath/Page/about.php



--------------------------------------
 TEMPLATE ENGINE
--------------------------------------

"CloneNjin/system/core/CloneNjin.php"

The template engine parses files that contain no PHP code (html aliases or templates) and exist outside the public web root. It replaces the existing raw keys with real values. Keys are registered in controller methods corresponding to actual keys in an alias files or template files. This process is what creates the "true view" or "clone". If a registered key doesn't exist in that alias, or it does but isn't registered, the template engine simply continues parsing until it reaches the end of the file. IMPORTANT: All your views and assets are outside the root and these are what the template engine determines to clone at run time !!! Extend the template engine and create a class for each folder in the public web root and a method for each page in that folder. Then duplicate this file structure outside of the web root in CloneNjin/views folder but using html only and any {{keys}}.



--------------------------------------
 Init
--------------------------------------

"CloneNjin/init.php"

The init.php file should be included in all "true views" (PHP pages in the web root corresponding to alias pages outside of the public web root)!
This file determines which controller to load and which method to call.
The controller loaded corresponds to the current view's parent directory name.
The method called corresponds to the current view's name.
The files calling the init file should only ever be clones!
If you have a separate pages or other project folders of your own,
simply don't include this.



--------------------------------------
 public web root
--------------------------------------

Clones go here.
All clones are php files being the "true views" and should only contain php code!
The template engine processes and clones views built from the views folder located outside the public web root.
For this reason, put all html and front-end logic "outside" of the public web root and inside CloneNjin/application/views.



--------------------------------------
 CONTROLLERS
--------------------------------------

"CloneNjin/controllers"

Controllers can extend/inheret the CloneNjin class.
A Controller class name and its file name should match the private and public folder name storing views.
A method name should correspond to the page name.