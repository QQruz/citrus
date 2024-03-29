<?php

namespace App\Models;

use App\Models\Model;

class User extends Model {

    protected $table = 'users';

    protected $columns = ['username', 'password'];

    public function findByName(string $name) {
        $sql = "SELECT * FROM $this->table WHERE `username`='$name'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetch();

        if ($row) {
            return $this->setAttributes($row);
        }
        
        return null;
    }
}