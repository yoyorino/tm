<?php
require_once 'db_connect.php';

class User extends DatabaseObject {

    protected static $table_name = 'tblUsers';
    public $usEmail, $usRole, $usName, $usSurname, $usPass, $usDateJoined;

    public function full_name() {
        if (isset($this->usName) && isset($this->usSurname)) {
            return $this->usName . ' ' . $this->usSurname;
        } else {
            return '';
        }
    }

    public static function authenticate($email, $password) {
        $sql = 'SELECT * FROM tblUsers WHERE usEmail = :email';
        $user = self::find_by_sql($sql, ['email' => $email]);
        if (empty($user)) {
            return false;
        } else {
            $user = array_shift($user);
            if (password_verify($password, $user->usPass)) {
                return $user;
            };
        }
    }
}

