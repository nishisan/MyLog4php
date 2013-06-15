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
$CONFIG["LOGGER"]["INFO"]  = true;
$CONFIG["LOGGER"]["DEBUG"] = true;
$CONFIG["LOGGER"]["WARN"]  = true;
$CONFIG["LOGGER"]["ERROR"] = true;


$CONFIG["LOGGER"]["PATH"] = "/tmp/portalIngests-default.log";
$CONFIG["LOGGER"]["FILTER"]["*Dao.php"] = "/tmp/portalIngests-sql.log";

// System Root Path.
$CONFIG["APP_PATH"] = "/app/voc/portalingest";
</pre>