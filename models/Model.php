<?php
class Model {
    protected $db;
    
    public function __construct() {
        global $conn;
        $this->db = $conn;
    }
    
    // Execute query
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    // Get a single record
    public function getSingle($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }
    
    // Get multiple records
    public function getMultiple($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    // Count rows
    public function rowCount($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
    
    // Get last insert ID
    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
}