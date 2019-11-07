<?php

namespace App\Models;

use App\Models\Model;

class Comment extends Model {

    protected $table = 'comments';

    protected $columns = ['name', 'email', 'body', 'approved'];

    public function getCommentsByVisibility(bool $visible, int $pageSize = null, int $page = null) {
        $visible = (int)$visible;
        $sql = "SELECT * FROM $this->table WHERE `approved` = $visible";

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

    public function approved(int $pageSize = null, int $page = null) {
        return $this->getCommentsByVisibility(true, $pageSize, $page);
    }

    public function notApproved(int $pageSize = null, int $page = null) {
        return $this->getCommentsByVisibility(false, $pageSize, $page);
    }
}