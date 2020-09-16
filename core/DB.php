<?php
namespace Core;
use \PDO;

class DB {
    private static $instance = null;
    private $connection;
    private $query;
    private $pdo;
    private $error = false;
    private $result;
    private int $count = 0;
    private $lastInsertID = null;


    private function __construct(DatabaseConnection $connect) {
        $this->connection = $connect;
        $this->pdo = $this->connection->getPDO();
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            $connect = new DatabaseConnection();
            self::$instance = new self($connect);
        }
        return self::$instance;
    }

    public function query($sql, $params = [], $class = false) {
        $this->error = false;
        if($this->query = $this->pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->query->execute()) {
                if($class) {
                    $this->result = $this->query->fetchAll(PDO::FETCH_CLASS, $class);
                } else {
                    $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
                }
                $this->count = $this->query->rowCount();
                $this->lastInsertID = $this->pdo->lastInsertId();
            } else {
                $this->error = true;
            }
        }
        return $this;
    }

    public function get() {
        return $this->result;
    }

    public function getFirst() {
        return $this->result[0];
    }

    public function selectAll($table, $params=[], $class = false) {
        $where = '';
        $bind = [];
        foreach ($params as $column=>$value) {
            $where .= $column.'=? AND ';
            $bind[] = $value;
        }
        $where = rtrim($where, ' AND ');
        $sql = "SELECT * FROM {$table} WHERE {$where}";
        return $this->query($sql, $bind, $class);
    }

    public function insert($table, $fields = []) {
        $fieldString = '';
        $valueString = '';
        $values = [];

        foreach($fields as $field => $value) {
            $fieldString .= '`' . $field . '`,';
            $valueString .= '?,';
            $values[] = $value;
        }
        $fieldString = rtrim($fieldString, ',');
        $valueString = rtrim($valueString, ',');
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
        if(!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }

    public function update($table, $id, $fields = []) {
        $fieldString = '';
        $values = [];
        foreach($fields as $field => $value) {
            $fieldString .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString, ',');
        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
        if(!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";
        if(!$this->query($sql)->error()) {
            return true;
        }
        return false;
    }

    public function get_columns($table) {
        return $this->query("SHOW COLUMNS FROM {$table}")->get();
    }

    public function count() {
        return $this->count;
    }

    public function error() {
        return $this->error;
    }
}