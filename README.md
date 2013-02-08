# ClientInfo
- - -

# Intro

This CakePHP plugin fills a session variable with your client's (visitor) OS, browser and browserversion to Use at your convenience.


# Installation and Setup


(1) Check out a copy of the ClientInfo CakePHP plugin from the repository using Git :

	git clone http://github.com/stefanvangastel/CakePHP-ClientInfo.git

or download the archive from Github: 

	https://github.com/stefanvangastel/CakePHP-ClientInfo/archive/master.zip

You must place the ClientInfo CakePHP plugin within your CakePHP 2.x app/Plugin directory.

(2) Load the plugin in app/Config/bootstrap.php

// Load ClientInfo plugin, with loading routes for short urls
	
	CakePlugin::load('ClientInfo');

(3) Load the Component in your AppController to get the info in the session var. Your $components array may then look like this:

	public $components = array(
		'Session',
		'RequestHandler',
		'ClientInfo.ClientInfo', // <- This is the line which will trigger the magic
		'DebugKit.Toolbar'
	);


**NOTE:** The component contains a session check to prevent double setting of vars and unnecessary actions.

# Usage

You can use get the variable like this:

	$clientinfo = CakeSession::read('ClientInfo');

A var_dump of $clientinfo will then look something like this:

	array(2) {
	  ["Os"]=>
	  string(9) "Windows 7"
	  ["Browser"]=>
	  array(2) {
	    ["name"]=>
	    string(6) "Chrome"
	    ["version"]=>
	    string(12) "24.0.1312.57"
	  }
	}

Ofcourse you can also use specific info directly in a condition:

	if( CakeSession::read('ClientInfo.Browser.name') == 'Internet Explorer' ){
		//Make complex workaround
	}