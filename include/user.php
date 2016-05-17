<?php
require_once 'db_connect.php';

class User {

    public $usEmail, $usRole, $usName, $usSurname, $usPass, $usDateJoined;

    public static function find_all_users(){
        return self::find_by_sql('SELECT * FROM tblUsers');
    }


    /**
     * @param string $email
     * @return bool|object
     */
    public static function find_by_email($email) {
        $row = self::find_by_sql('SELECT * FROM tblUsers WHERE usEmail = :email', ['email' => $email]);

        // if there is a record, return it
        return !empty($row) ? array_shift($row) : false;
    }

    // converts stdClass to User class
    public static function find_by_sql($sql, $params = null) {
        global $database;
        $result_set = $database->query($sql, $params);

        $object_array = [];
        foreach ($result_set as $record) {
            $object_array[] = self::instantiate($record);
        }
        return $object_array;
    }

    public function full_name() {
        if (isset($this->usName) && isset($this->usSurname)) {
            return $this->usName . ' ' . $this->usSurname;
        } else {
            return '';
        }
    }

    private static function instantiate($record) {
        $object = new self;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }

        return $object;
    }

    private function has_attribute($attribute) {
        $object_vars = get_object_vars($this);

        return array_key_exists($attribute, $object_vars);
    }
}

