<?php
//konekcija
require_once  "db_config.php";

class PDODatabase {


    /** @var  object, PDO object */
    private $database_handle;

    /** @var bool , Connected to the database */
    private $is_connected = false;

    /** @var  object, PDOStatement object */
    private $statement_handle;

    /** @var  array, parameters for the prepared sql */
    private $parameters;

    /**
     * PDODatabase constructor.
     */
    public function __construct() {
        $this->open_connection(DB_DSNTM, DB_USER, DB_PASS);
    }

// staro
//    /**
//     * PDODatabase constructor.
//     * @param string $dsn
//     * @param string $db_user
//     * @param string $db_pass
//     */
//    public function __construct($dsn, $db_user, $db_pass) {
//        $this->open_connection($dsn, $db_user, $db_pass);
//    }

    /**
     * Method that makes the connection to the database
     * 1. Tries to connect to the database
     * 2. If connection failed, exception is displayed
     * @param string $dsn
     * @param string $db_user
     * @param string $db_pass
     */
    private function open_connection($dsn, $db_user, $db_pass) {
        try {
            $this->database_handle = new PDO($dsn, $db_user, $db_pass);

            /** set the PDO to throw an exception */
            $this->database_handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /** use real prepared statements instead of emulated */
            $this->database_handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            /** sets the queries to return objects as results */
            $this->database_handle->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            /**
             * true if the connection is successful
             * @var boolean is_connected */
            $this->is_connected = true;
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    public function get_connection() {
        return $this->database_handle;
    }

    /**
     * method for closing the connection
     * sets the connection handle to null
     */
    public function close_connection() {
        $this->database_handle = null;
    }

    /**
     * @param string $sql
     * @param string $parameters
     */
    private function init($sql, $parameters = '') {
        // connect to database if not
        if (!$this->database_handle) {
            $this->open_connection(DB_DSNTM, DB_USER, DB_PASS);
        }

        // prepare the query
        try {
            // prepare
            $this->statement_handle = $this->database_handle->prepare($sql);

            // add parameters to parameter array
            $this->bind_more($parameters);

            // bind parameters
            if (!empty($this->parameters)) {
                foreach ($this->parameters as $param => $value) {

                    $type = PDO::PARAM_STR;
                    switch ($value[1]) {
                        case is_int($value[1]):
                            $type = PDO::PARAM_INT;
                            break;
                        case is_bool($value[1]):
                            $type = PDO::PARAM_BOOL;
                            break;
                        case is_null($value[1]):
                            $type = PDO::PARAM_NULL;
                            break;
                    }
                    // add type when binding the values to the column
                    $this->statement_handle->bindValue($value[0], $value[1], $type);
                }
            }

            // execute sql
            $this->statement_handle->execute();
        } catch (PDOException $e) {
            die('Query error: ' . $e->getMessage());
        }

        // reset the parameters
        $this->parameters = [];
    }

    /**
     * Add parameter to the parameter array
     * @param string $para
     * @param string $value
     */
    public function bind($para, $value) {
        $this->parameters[count($this->parameters)] = [':' . $para , $value];
    }

    /**
     * Add more parameters to the parameter array
     * @param array $p_array
     */
    public function bind_more($p_array) {
        if (empty($this->parameters) && is_array($p_array)) {
            $columns = array_keys($p_array);
            foreach ($columns as $i => &$column) {
                $this->bind($column, $p_array[$column]);
            }
        }
    }

    /**
     * If the SQL query  contains a SELECT or SHOW statement it returns an array containing all of the result set row
     * If the SQL statement is a DELETE, INSERT, or UPDATE statement it returns the number of affected rows
     *
     * @param string $sql
     * @param null $params
     * @param null $fetch_mode
     * @return mixed
     */
    public function query($sql, $params = null, $fetch_mode = null)
    {
        $sql = trim(str_replace('\r', ' ', $sql));
        $this->init($sql, $params);

        // breaks the query in words
        $raw_sql = explode(" ", preg_replace("/\s+|\t+|\n+/", " ", $sql));

        // which sql statement is used
        $statement = strtolower($raw_sql[0]);

        if ($statement == 'select' || $statement == 'show') {
            return $this->statement_handle->fetchAll($fetch_mode);
        } elseif ($statement == 'update' || $statement == 'delete' || $statement == 'insert') {
            return $this->statement_handle->rowCount();
        } else {
            return null;
        }
    }

    /**
     * Returns the last inserted id
     * @return string
     */
    public function last_inserted_id()
    {
        return $this->database_handle->lastInsertId();
    }

    /**
     * Starts the transaction
     * @return boolean, true on success or false on failure
     */
    public function begin_transaction()
    {
        return $this->database_handle->beginTransaction();
    }

    /**
     * Commits a transaction
     * @return boolean
     */
    public function execute_transaction()
    {
        return $this->database_handle->commit();
    }

    /**
     * Rolls back the current transaction
     * @return boolean
     */
    public function roll_back()
    {
        return $this->database_handle->rollBack();
    }

    /**
     * Returns an array which represents a column from the result set
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function column($sql, $params = null)
    {
        $this->init($sql, $params);
        $columns = $this->statement_handle->fetchAll(PDO::FETCH_NUM);
        $column = null;

        foreach ($columns as $cells) {
            $column[] = $cells[0];
        }
        return $column;
    }

    /**
     * Returns an array which represents a row from the result set
     * @param string $sql
     * @param array $params
     * @param int $fetch_mode
     * @return array
     */
    public function row($sql, $params = null, $fetch_mode = PDO::FETCH_ASSOC)
    {
        $this->init($sql, $params);
        $result = $this->statement_handle->fetch($fetch_mode);

        // Frees up the connection to the server so that other SQL statements may be issued
        $this->statement_handle->closeCursor();
        return $result;
    }

    public function table($sql){
        $result = $this->query($sql);
        return $result;
    }
    /**
     * Fetch the first column from the first row in the result set
     * e.g.
     * $pics = $db->query('SELECT COUNT(id) FROM pics');
     * $this->totalpics = $pics->fetchColumn();
     *
     * @param string $sql
     * @param array $params
     * @return string
     */
    public function single($sql, $params = null)
    {
        $this->init($sql, $params);
        $result = $this->statement_handle->fetchColumn();

        // Frees up the connection to the server so that other SQL statements may be issued
        $this->statement_handle->closeCursor();
        return $result;
    }
}

$database = new PDODatabase();