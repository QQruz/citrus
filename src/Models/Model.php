<?php

namespace App\Models;

abstract class Model {
    
    protected $db;
    protected $table;
    protected $columns;
    protected $attributes;

    public function __construct(array $attributes = []) {
        $this->db = getDbConnection();
        $this->setAttributes($attributes);
    }

    public function __set(string $attribute, $value) {
        if (!in_array($attribute, $this->columns) && $attribute !== 'id') {
            throw new \Exception('Invalid attribute');
        }

        $this->attributes[$attribute] = $value;
    }

    public function __get(string $attribute) {
        return isset($this->attributes[$attribute]) ? $this->attributes[$attribute] : null;
    }

    protected function setAttributes(array $attributes) {
        foreach ($attributes as $column => $value) {
            $this->attributes[$column] = $value;
        }

        return $this;
    }

    public function getTable() {
        return $this->table;
    }

    public function save() {
        if ($this->id) {
            $this->update();
        } else {
            $this->create();
        }

        return $this;
    }

    public function create() {
        $columns = implode(',', array_keys($this->attributes));
        $placeholders = implode(',', array_fill(0, count($this->attributes), '?'));
        $data = array_values($this->attributes);

        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";

        $stmt = $this->db->prepare($sql);

        $success = $stmt->execute($data);

        if ($success) {
            $this->id = $this->db->lastInsertId();
        }

        return $this;
    }

    public function update() {
        
        if (!$this->id) {
            throw new \Exception('Cannot update unsaved object');
        }

        $sql = "UPDATE $this->table SET";
        $data = [];

        foreach( $this->attributes as $column => &$value) {
            if ($column === 'id') {
                continue;
            }

            $sql .= "`$column`=?,";
            $data[] = $value;
        }

        $sql = rtrim($sql, ',');

        $sql .= " WHERE `id`=" . $this->id;

        $stmt = $this->db->prepare($sql);

        $stmt->execute($data);

        return $this;

    }

    public function all(int $pageSize = null, int $page = null) {
        $sql = "SELECT * FROM $this->table";

        if ($pageSize) {
            $sql .= " LIMIT $pageSize";
        }

        if ($page) {
            $sql .= " OFFSET " . $pageSize * $page;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findById(int $id) {
        $sql = "SELECT * FROM $this->table WHERE `id`=$id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();

        if ($row) {
            return $this->setAttributes($row);
        }
        
        return null;
    }

}