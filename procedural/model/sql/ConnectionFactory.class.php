<?php
class ConnectionFactory {

    private static $instance;

    public static function getInstance() {
        
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO('mysql:host=' .
                        ConnectionProperty::getHost() .
                        ';dbname=' .
                        ConnectionProperty::getDatabase().';charset=utf8', ConnectionProperty::getUser(), ConnectionProperty::getPassword());
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }

    public static function prepare($sql) {
        return self::getInstance()->prepare($sql);
    }

}
