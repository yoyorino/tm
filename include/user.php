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

    public static function register($firstname, $lastname, $email, $password, $code){
        $isValid = self::CheckCodeValid($code);
        if (sizeof($isValid) > 0) {
            if ($isValid === false)
                return ($isValid);
            else {
                if ($isValid[0]->akUsed == 0) {
                    $passhash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                    $tmp = ['email' => $email, 'fname' => $firstname, 'lname' => $lastname, 'pass' => $passhash, 'role' => 4, 'codeid' => intval($isValid[0]->akId)];
                    var_dump($tmp);
                    echo '<br>';
                    self::InsertUser($tmp);
                }
                else
                    return false;
            }
        }
        else return false;
    }
    private function InsertUser($tmp){
        $sql = 'INSERT INTO `tblUsers`(`usEmail`, `usName`, `usSurname`, `usPass`, `usRole`, `usCodeId`) VALUES (:email,:fname,:lname,:pass, :role ,:codeid);';
        var_dump($sql);
        global $database;
        $database->query($sql,$tmp);
    }
    public static function CheckCodeValid($code){

        $tmp = (new DBCode())->readContent($code);
        var_dump($tmp);
        return $tmp;

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

