<?php
require_once LIB_PATH . DS . 'db_connect.php';

class DatabaseObject {

    /**
     * @return array
     */
    public static function find_all(){
        return static::find_by_sql('SELECT * FROM ' . self::$table_name);
    }

    /**
     * @param integer $id
     * @return bool|object
     */
    public static function find_by_id($id) {
        $row = static::find_by_sql('SELECT * FROM ' . self::$table_name . ' WHERE id = :id', ['id' => $id]);

        // if there is a record, return it
        return !empty($row) ? array_shift($row) : false;
    }


    /**
     * @param string $email
     * @return bool|object
     */
    public static function find_by_email($email) {
        $row = static::find_by_sql('SELECT * FROM ' . self::$table_name .' WHERE usEmail = :email', ['email' => $email]);

        // if there is a record, return it
        return !empty($row) ? array_shift($row) : false;
    }
    /**
     * executes sql query against the db
     * converts stdClass to User class
     * @param string $sql
     * @param array $params
     * @return array
     */
    public static function find_by_sql($sql, $params = null) {
        global $database;
        $result_set = $database->query($sql, $params);

        $object_array = [];
        foreach ($result_set as $record) {
            $object_array[] = static::instantiate($record);
        }
        return $object_array;
    }

    /**
     * @param array $record
     * @return User
     */
    private static function instantiate($record) {
        $object = new static;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }

        return $object;
    }

    /**
     * @param $attribute
     * @return bool
     */
    private function has_attribute($attribute) {
        $object_vars = get_object_vars($this);

        return array_key_exists($attribute, $object_vars);
    }
}