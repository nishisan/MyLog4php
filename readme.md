MyLog4php
=============
This is another class for php logging.

Features
-------
* Log multiple files based on filter..
* Severity filter to log messages...

Todo
-------
* Log to Syslog ( Only for *unix Systems ).

Configuration
-------------
In order to be configured the class constructor expects a CONFIG hash;
Here you will see the config options:
<pre>
//Logger settings.
$CONFIG["LOGGER"]["INFO"]  = true; //Enable INFO Level logging
$CONFIG["LOGGER"]["DEBUG"] = true; //Enable DEBUG Level logging
$CONFIG["LOGGER"]["WARN"]  = true; //Enable WARN Level logging
$CONFIG["LOGGER"]["ERROR"] = true; //Enable ERROR Level logging

// The setting bellow is to set the default log file.
$CONFIG["LOGGER"]["PATH"] = "/tmp/portalIngests-default.log";
// You can log messages in multiples files depending on the souce file
// Here is an example that will log messages from anyfile that matches the filter to another file
$CONFIG["LOGGER"]["FILTER"]["*Dao.php"] = "/tmp/portalIngests-sql.log";

// System Root Path.
$CONFIG["APP_PATH"] = "/var/www/system";
</pre>

Logger Levels
-------------

This class supports:

* INFO
* DEBUG
* WARN
* ERROR

The logDumpObj method will always log as DEBUG level.

Multiple logging files
-------------
In order to have multiple logging files you´ll have to create a filter.<br>
For instance lets say you have a file called login.php and you want all messages from login.php to be logged in '/tmp/login.log'<br>
Create a filter like:
<pre>
    $CONFIG["LOGGER"]["FILTER"]["login.php"] = "/tmp/login.log";
</pre>

The filter option accepts glob like filter so the wildcard mark is *

Usage example
-------------
<pre>
<?php

/**
 * Require the class file;
 */
require_once("MyLog4php.php");

$CONFIG["LOGGER"]["INFO"] = true; //Enable INFO Level logging
$CONFIG["LOGGER"]["DEBUG"] = true; //Enable DEBUG Level logging
$CONFIG["LOGGER"]["WARN"] = true; //Enable WARN Level logging
$CONFIG["LOGGER"]["ERROR"] = true; //Enable ERROR Level logging
// The setting bellow is to set the default log file.
$CONFIG["LOGGER"]["PATH"] = "/tmp/portalIngests-default.log";
// You can log messages in multiples files depending on the souce file
// Here is an example that will log messages from anyfile that matches the filter to another file
$CONFIG["LOGGER"]["FILTER"]["*Dao.php"] = "/tmp/portalIngests-sql.log";

// System Root Path.
$CONFIG["APP_PATH"] = "/var/www/system";

/**
 * Create the logger
 */
$logger = new MyLog4php($CONFIG);

/**
 * Log D ebug Message
 */
$logger->debug("Debug Message");

/**
 * Log an Error
 */
$logger->error("Error Message");

/**
 * Log Info Message
 */
$logger->info("Info Message");


/**
 * The logDumpObj method will log any object.
 * It will write a print_r like output to the log file.
 */
$obj = $_REQUEST;
$logger->logDumpObj($obj)
?>

</pre>
