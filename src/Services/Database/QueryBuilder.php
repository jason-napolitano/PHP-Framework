<?php

namespace Core\Services {

    // IMPORTS ----------------------------------------------------------------
    use PDO;
    use PDOException;

    /**
     * ------------------------------------------------------------------------
     * MySQL Query Builder Class. Requires PHP >=8.0.0
     * ------------------------------------------------------------------------
     *
     * @link    http://g2pc1.bu.edu/~qzpeng/manual/MySQL%20Commands.htm
     * @author  Curtis Parham
     * @author  Jason Napolitano
     *
     * MySQL Commands:
     * @package Core\QueryBuilder
     */
    trait QueryBuilder
    {
        /**
         * Class instance
         *
         * @var QueryBuilder $instance
         */
        public static QueryBuilder $instance;

        /**
         * PDO instance
         *
         * @see \PDO
         *
         * @var PDO $pdo
         */
        private static PDO $pdo;

        /**
         * Raw query string
         *
         * @var string $rawQuery
         */
        private static string $rawQuery;

        /**
         * ID of the last inserted row or
         * sequence value
         *
         * @see \PDO::lastInsertId()
         *
         * @var int $lastID
         */
        protected int $lastID;

        /**
         * Is there an error?
         *
         * @var bool $error
         */
        private bool $error = false;

        /**
         * The stored result set
         *
         * @var mixed $result
         */
        private mixed $result;

        /**
         * Counter
         *
         * @var int $count
         */
        private int $count = 0;

        /**
         * Connection credentials
         *
         * @var string $hostname
         * @var string $username
         * @var string $password
         */
        private string $hostname, $username, $password, $database;

        //---------------------------------------------------------------------

        /**
         * QueryBuilder constructor
         */
        public function __construct()
        {
            try {
                $this->hostname ??= getenv('DB_HOSTNAME') ?? 'localhost';
                $this->username ??= getenv('DB_USERNAME') ?? 'root';
                $this->password ??= getenv('DB_PASSWORD') ?? '';
                $this->database ??= getenv('DB_DATABASE') ?? '';

                self::$pdo = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->database, $this->username, $this->password);
            } catch ( PDOException $e ) {
                die($e->getMessage());
            }
        }

        //---------------------------------------------------------------------

        /**
         * Get class instance
         *
         * @return self
         */
        public static function getInstance(): self
        {
            if ( ! isset(self::$instance) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        //---------------------------------------------------------------------

        public function select($table, $condition, $operator, $bind, $order = '', $limit = ''): bool
        {
            $params = [];
            $params['conditions'] = $condition;
            $params['operator'] = $operator;
            $params['bind'] = $bind;
            $params['order'] = $order;
            $params['limit'] = $limit;
            return $this->read($table, $params);
        }

        //---------------------------------------------------------------------

        /**
         * Read function
         *
         * @param       $table
         * @param array $params
         *
         * @return bool
         */
        protected function read($table, $params = []): bool
        {
            $conditionString = '';
            $operator = '';
            $bind = [];
            $order = '';
            $limit = '';

            // Plot Conditions
            if ( isset($params['conditions']) ) {
                if ( is_array($params['conditions']) ) {
                    $x = 0;
                    foreach ( $params['conditions'] as $condition ) {
                        if ( array_key_exists('operator', $params) ) {
                            $operator = $params['operator'];
                        }
                        $conditionString .= ' ' . $condition . ' ' . $operator[$x] . ' ? ' . ' AND';
                        $x++;
                    }
                    $conditionString = trim($conditionString);
                    $conditionString = rtrim($conditionString, ', AND');
                } else {
                    $conditionString = $params['conditions'];
                }
            }
            if ( $conditionString !== '' ) {
                $conditionString = ' WHERE ' . $conditionString;
            }

            // Bind
            if ( array_key_exists('bind', $params) ) {
                $bind = $params['bind'];
            }

            // Order
            if ( array_key_exists('order', $params) && $params['order'] !== '' ) {
                $order = ' ORDER BY ' . $params['order'];
            }

            // Limit
            if ( array_key_exists('limit', $params) && $params['limit'] !== '' ) {
                $limit = ' LIMIT ' . $params['limit'];
            }

            $sql = "SELECT * FROM $table{$conditionString}{$order}{$limit}";
            if ( $this->query($sql, $bind) ) {
                if ( ! count($this->result) ) {
                    return false;
                }
                return $this->getResult();
            }
            return false;
        }

        //---------------------------------------------------------------------

        /*
         * Simple Select
         */

        /**
         * Raw SQL Query
         *
         * @param       $sql
         * @param array $params
         *
         * @return $this
         */
        public function query($sql, $params = []): self
        {
            $this->error = false;

            // prepare sql
            if ( self::$rawQuery = self::$pdo->prepare($sql) ) {
                $x = 1;

                // count params
                if ( count($params) ) {
                    foreach ( $params as $param ) {
                        self::$rawQuery->bindValue($x, $param);
                        $x++;
                    }
                }

                // query execution
                if ( self::$rawQuery->execute() ) {
                    $this->result = self::$rawQuery->fetchALL(PDO::FETCH_OBJ);
                    $this->count = self::$rawQuery->rowCount();
                    $this->lastID = self::$pdo->lastInsertId();
                } else {
                    $this->error = true;
                }
            }
            return $this;
        }

        //---------------------------------------------------------------------

        /**
         * Return result
         *
         * @return mixed
         */
        public function getResult(): mixed
        {
            return $this->result;
        }

        //---------------------------------------------------------------------

        /**
         * INSERT Statement
         *
         * @param       $table
         * @param array $fields
         *
         * @return bool
         */
        public function insert($table, $fields = []): bool
        {
            $fieldString = '';
            $valueString = '';
            $values = [];
            foreach ( $fields as $field => $value ) {
                $fieldString .= '`' . $field . '`,';
                $valueString .= '?,';
                $values[] = $value;
            }

            $fieldString = rtrim($fieldString, ',');
            $valueString = rtrim($valueString, ',');
            $sql = "INSERT INTO $table ($fieldString) VALUES ($valueString)";

            if ( ! $this->query($sql, $values)->error() ) {
                return true;
            }
            return false;
        }

        //---------------------------------------------------------------------

        /**
         * Generate SQL Error
         *
         * @return bool
         */
        public function error(): bool
        {
            return $this->error;
        }

        //---------------------------------------------------------------------

        /**
         * UPDATE Statement
         *
         * @param       $table
         * @param array $fields
         * @param array $where
         *
         * @return bool
         */
        public function update($table, $fields = [], $where = []): bool
        {
            $fieldString = '';
            $values = [];
            $whereString = '';
            foreach ( $fields as $field => $value ) {
                $fieldString .= '`' . $field . '`= ?,';
                $values[] = $value;
            }

            foreach ( $where as $w => $val_w ) {
                $whereString .= '`' . $w . '` = ' . $val_w;
            }

            $fieldString = rtrim($fieldString, ',');
            $sql = "UPDATE $table SET $fieldString WHERE $whereString";

            if ( ! $this->query($sql, $values)->error() ) {
                return true;
            }
            return false;
        }

        //---------------------------------------------------------------------

        /**
         * DELETE Statement
         *
         * @param       $table
         * @param array $fields
         *
         * @return bool
         */
        public function delete($table, $fields = []): bool
        {
            $fieldString = '';
            $values = [];
            foreach ( $fields as $field => $value ) {
                $fieldString .= '`' . $field . '`= ?';
                $values[] = $value;
            }
            $sql = "DELETE FROM $table WHERE $fieldString";

            if ( ! $this->query($sql, $values)->error() ) {
                return true;
            }
            return false;
        }

        //---------------------------------------------------------------------

        /**
         * Return count
         *
         * @return int
         */
        public function count(): int
        {
            return $this->count;
        }
    }
}
