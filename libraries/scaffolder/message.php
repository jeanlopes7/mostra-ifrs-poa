<?php

/**
* Util messages to scaffolder
**/
class Message {

    var $test;

    public function __construct($test = false){
        $this->test = $test;
    }
    /**
    * Function to write text
    * Can be changed to a log file for example
    */
    private function write($text){
        echo $text;
    }
    /**
    * Text to separate other texts to user log
    */
    public function separator(){
        $this->write("====================================================================================<br/>");
    }
    /**
    * Log file that is being created if not testing
    **/
    public function log($text){
        if(!$this->test){
            $this->separator();
            $this->write("Generating ${text}.php... ");
        }
    }
    /**
    * Done message to be displayed after a task
    **/
    public function done(){
        if(!$this->test){
            $this->write("DONE! <br/>");
        }
    }
    /**
    * Message to say that user has no permission to write at default $paths
    **/
    public function cannotWrite(){
        $this->separator();
        $this->write("Can't write at controllers, models, and/or views path. Verify permissions.<br/>");
        $this->separator();
    }
    /**
    * Success message to be displayed at the finish of scaffold tasks
    */
    public function success($table){
        if(!$this->test){
            $this->separator();
            $this->write("Scaffold for table $table generated sucessfully! <br/>");
            $this->separator();
        }
    }
}
