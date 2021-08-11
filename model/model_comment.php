<?php
class Comment {
    private $id;
    private $post_id;
    private $user_id;
    private $comment_content;
    private $comment_date;

// Constructeur

function __construct($post_id, $user_id, $comment_content, $comment_date) {
    $this->_post_id = $post_id;
    $this->_user_id = $user_id;
    $this->_comment_content = $comment_content;
    $this->_comment_date = $comment_date;
}

// Getter

public function id() {
    return $this->_id;
}

public function postId() {
    return $this->_post_id;
}

public function userId() {
    return $this->_user_id;
}

public function commentContent() {
    return $this->_comment_content;
}

public function commentDate() {
    return $this->_comment_date;
}

// Setter

public function setId() {
    $this->_id = $id;
}

public function setPostId($post_id) {
    $this->_post_id = $post_id;
}

public function setUserId($user_id) {
    $this->_user_id = $user_id;
}

public function setCommentContent($comment_content) {
    $this->_comment_content = $comment_content;
}

public function setCommentDate($comment_date) {
    $this->_comment_date = $comment_date;
}

// Hydrate

public function hydrate(array $data)
    {
        if (isset($data['id']))
        {
        $this->setId($data['id']);
        }

        if (isset($data['post_id']))
        {
            $this->setPostId($data['post_id']);
        }

        if (isset($data['user_id']))
        {
            $this->setUserId($data['user_id']);
        }

        if (isset($data['comment_content']))
        {
            $this->setCommentContent($data['comment_content']);
        }

        if (isset($data['comment_date']))
        {
            $this->setCommentDate($data['comment_date']);
        }
    }
}

class CommentManager {
    private $_db;

    function __construct($db) {
        $this->setDb($db);
    }

    public function setDb($db)
    {
       $this->_db = $db;
    }

// Method

    public function getComments($post_id)
    {
        $sql = 'SELECT id, post_id, user_id, comment_content, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comment WHERE post_id = ? ORDER BY comment_date DESC';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($postId));
        $comments = $stmt;

        return $comments;
    }

    public function postComment($post_id, $user_id, $comment_content)
    {
        $sql = 'INSERT INTO comment(post_id, user_id, comment_content, comment_date) VALUES(?, ?, ?, NOW())';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($post_id, $user_id, $comment_content));
        $affected_lines = $stmt;

        return $affected_lines;
    }
}