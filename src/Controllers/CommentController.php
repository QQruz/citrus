<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller {
    
    public function create() {
        // $this->validate($_POST);

        if (isset($_SESSION['errors'])) {
            back();
        }

        $comment = new Comment($_POST);

        $comment->save();

        $_SESSION['success'] = $comment->id;

        back();
    }

    public function approve() {
        if (!isset($_SESSION['user'])) {
            redirect(PUBLIC_PATH . 'login');
        }

        $comment = new Comment;
        $comment = $comment->findById($_POST['id']);
        $comment->approved = true;
        $comment->save();

        back();
    }
}