<?php

define("EXT", ".php");
define("BASEPATH", "/home/gabriel/apps/php/scaffold/system/");
define("APPPATH", "/home/gabriel/apps/php/scaffold/system/application/");

require("scaffolder.php");


class ScaffolderTest {
    var $scaffolder;
    
    public function __construct(){
        $this->scaffolder = new Scaffolder(true);
    }
    /**
    * Include template file and returns variable $($name)_template content
    * Eg.: if $name = controller
    * returns variable $controller_template value that is into the TEMPLATE_CONTROLLER file
    */
    private function getTemplate($name){
        $var_name = "TEMPLATE_" . strtoupper($name);
        $template_name = constant($var_name);
        $template_name = str_replace("templates", "tests", $template_name);
        require($template_name);
        $template = $name . "_template";
        return $$template;
    }
    /**
    * Show user unit test results
    **/
    private function showAssertion($name, $result){
        $result = ($result) ? "<span style=\"color:green;\">Success</span>" : "<span style=\"color:red;\">Failure</span>";
        echo "<table border=\"1\" width=\"50%\"><caption style=\"font-weight:bold;\">${name}</caption><tr><td>Result</td><td>${result}</td></tr></table>";
    }
    /**
    * Verifies if $test === $expected
    **/
    private function assert($test, $expected, $name){
        if(is_string($test)){
            $test = $this->parseText($test);
        }
        if(is_string($expected)){
            $expected = $this->parseText($expected);
        }
        $this->showAssertion($name, $test === $expected);
    }
    /**
    * Verifies if $test is not null or an empty string
    **/
    private function assertNotNull($test, $name){
        $this->showAssertion($name, $test != null && $test != "" && $test != false);
    }
    /**
    * Parse text to compare removing spaces 
    **/
    private function parseText($text){
        return preg_replace('/\s/', "", $text);
    }
    /**
    * Generate random table fields to test
    **/
    private function getTableFields(){
        require_once(APPPATH . "libraries/scaffolder/drivers/field.php");

        $id = new Field();
        $id->setName("id");
        $id->setPk(true);

        $nome = new Field();
        $nome->setName("nome");

        $alias = new Field();
        $alias->setName("alias");

        $estado = new Field();
        $estado->setName("estado_id");

        return array( $id, $nome, $alias, $estado );
    }
    /**
    * Returns table primary key
    **/
    private function getTablePk($fields){
        foreach($fields as $field){
            if($field->isPk()){
                return $field;
                break;
            }
        }
    }
    /**
    * Test if controller content is being generated correctly
    **/
    public function testController(){
        $result = $this->scaffolder->createController("cidade");
        $expected = $this->getTemplate("controller");
        $this->assertNotNull($result, "Controller content not empty");
        $this->assert($result, $expected, "Controller OK");
    }
    /**
    * Test if model content is being generated correctly
    **/
    public function testModel(){
        $result = $this->scaffolder->createModel("cidade", $this->getTableFields());
        $expected = $this->getTemplate("model");
        $this->assertNotNull($result, "Model content not empty");
        $this->assert($result, $expected, "Model OK");
    }
    /**
    * Test if list view content is being generated correctly
    **/
    public function testListView(){
        $result = $this->scaffolder->createListView("cidade", $this->getTableFields());
        $expected = $this->getTemplate("list");
        $this->assertNotNull($result, "List view content not empty");
        $this->assert($result, $expected, "List view OK");
    }
    /**
    * Test if save view content is being generated correctly
    **/
    public function testSaveView(){
        $result = $this->scaffolder->createSaveView("cidade");
        $expected = $this->getTemplate("save");
        $this->assertNotNull($result, "Save view content not empty");
        $this->assert($result, $expected, "Save view OK");
    }
    /**
    * Test if delete view content is being generated correctly
    **/
    public function testDeleteView(){
        $result = $this->scaffolder->createDeleteView("cidade", $this->getTableFields());
        $expected = $this->getTemplate("delete");
        $this->assertNotNull($result, "Delete view content not empty");
        $this->assert($result, $expected, "Delete view OK");
    }
    /**
    * Test if form view content is being generated correctly
    **/
    public function testFormView(){
        $result = $this->scaffolder->createFormView("cidade", $this->getTableFields());
        $expected = $this->getTemplate("form");
        $this->assertNotNull($result, "Form view content not empty");
        $this->assert($result, $expected, "Form view OK");
    }
    /**
    * Verify if controller, views and models directories are writable
    **/
    public function verifyPaths(){
        return $this->scaffolder->verifyPaths();
    }
    /**
    * Verify if database driver is functional
    */
    public function testDriver(){
        require(BASEPATH.'codeigniter/Common'.EXT);
        require(BASEPATH.'codeigniter/Compat'.EXT);
        require(APPPATH.'config/constants'.EXT);
        require(BASEPATH.'codeigniter/Base5'.EXT);
        require_once(APPPATH . 'libraries/scaffolder/drivers/driver'.EXT);
        $test_table = 'cidade';
        $num_fields = 4;
        $pk = "id";
        $driver = Driver::getDriver();
        $tables = $driver->getTables();
        $this->assert(in_array($test_table, $tables), true, "Show test table");
        $fields = $driver->getFields($test_table);
        $this->assert(count($fields), $num_fields, "Display $num_fields fields");
        $primary_key = $this->getTablePK($fields);
        $this->assertNotNull($primary_key, "Has primary key");
        $this->assert($primary_key->getName(), $pk, "Primary Key equals $pk");
    }
    /**
    * Do all tests
    **/
    public function all(){
        if($this->verifyPaths()){
            $this->testController();
            $this->testModel();
            $this->testListView();
            $this->testSaveView();
            $this->testDeleteView();
            $this->testFormView();
            $this->testDriver();
        }
    }
}

$test = new ScaffolderTest();
$test->all();

