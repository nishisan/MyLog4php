<?php

class MyLog4php {

    /**
     *  This is the file Handle. 
     * @var handler 
     */
    private $fh;

    /**
     * Configuration Hash
     * @example path description
     * @var hash 
     */
    private $CONFIG;

    /**
     * Default constructor.
     * @global type $CONFIG
     */
    function __construct($CONFIG) {
        $this->CONFIG = $CONFIG;
    }

    /**
     *  Private method to set file handler
     * @param type $f
     */
    private function setFile($f) {
        $filename = $this->CONFIG["LOGGER"]["PATH"];
        foreach ($this->CONFIG["LOGGER"]["FILTER"] as $filter => $path) {
            if (fnmatch($filter, $f)) {
                $filename = $path;
                break;
            }
        }

        if (!file_exists($filename)) {
            $this->fh = fopen($filename, 'w') or die("Error opening log file -> $filename\n");
        } else {
            $this->fh = fopen($filename, 'a') or die("Error opening log file  -> $filename\n");
        }
    }

    /**
     * Wrapper for the real logging..
     * @global type $CONFIG
     * @param type $logmsg
     * @param type $severity
     */
    private function log($logmsg, $severity) {

        $f = $_SERVER ['SCRIPT_FILENAME'];
        $f = str_replace($this->CONFIG ["APP_PATH"], "", $f);
        $this->setFile($f);
        fwrite($this->fh, $this->getmicrotime() . " - " . $f . " [$severity] - " . $logmsg . "\n");
        fclose($this->fh);
    }

    /**
     * log a info level message.
     * @param type $logmsg
     */
    public function info($logmsg) {
        if ($this->CONFIG["LOGGER"]["INFO"]) {
            $this->log($logmsg, "INFO");
        }
    }

    /**
     * Log Debug message
     * @param type $logmsg
     */
    public function debug($logmsg) {
        if ($this->CONFIG["LOGGER"]["DEBUG"]) {
            $this->log($logmsg, "DEBUG");
        }
    }

    /**
     * Log an error message
     * @param type $logmsg
     */
    public function error($logmsg) {
        if ($this->CONFIG["LOGGER"]["ERROR"]) {
            $this->log($logmsg, "ERROR");
        }
    }

    /**
     * Log and SQL Query - Level is debug
     * @global type $CONFIG
     * @param type $logmsg
     */
    public function logQuery($logmsg) {

        $f = $_SERVER ['SCRIPT_FILENAME'];
        $f = str_replace($this->CONFIG ["APP_PATH"], "", $f);
        if ($CONFIG ["DEBUG_QUERY"]) {
            fwrite($this->fh, $this->getmicrotime() . " - " . $f . " -> \n" . $logmsg . "\n");
        }
    }

    /**
     * Create the microtime string
     * @return type
     */
    private function getmicrotime() {
        if (function_exists('gettimeofday')) {
            $tod = gettimeofday();
            $sec = $tod ['sec'];
            $usec = $tod ['usec'];
        } else {
            $sec = time();
            $usec = 0;
        }
        return strftime('%d-%m-%Y %H:%M:%S', $sec) . '.' . sprintf('%06d', $usec);
    }

    /**
     * Log and Object...
     * @param type $obj
     */
    public function logDumpObj($obj) {
        $output = print_r($obj, true);
        $this->debug($output);
    }

}

?>
