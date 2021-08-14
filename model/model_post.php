<?php
class Post {
    private $id;
    private $post_title;
    private $post_content;
    private $post_date;

// Constructeur

function __construct($post_title, $post_content, $post_date) {
    $this->_post_title = $post_title;
    $this->_post_content = $post_content;
    $this->_post_date = $post_date;
}

// Getter

public function id() {
    return $this->_id;
}

public function postTitle() {
    return $this->_post_title;
}

public function postContent() {
    return $this->_post_content;
}

public function postDate() {
    return $this->_post_date;
}

// Setter

public function setId() {
    $this->_id = $id;
}

public function setPostTitle($post_title) {
    $this->_post_title = $post_title;
}

public function setPostContent($post_content) {
    $this->_post_content = $post_content;
}

public function setPostDate($post_date) {
    $this->_post_date = $post_date;
}

// Hydrate

public function hydrate(array $data)
    {
        if (isset($data['id']))
        {
        $this->setId($data['id']);
        }

        if (isset($data['post_title']))
        {
            $this->setPostTitle($data['post_title']);
        }

        if (isset($data['post_content']))
        {
            $this->setPostContent($data['post_content']);
        }

        if (isset($data['post_date']))
        {
            $this->setPostDate($data['post_date']);
        }
    }
}

class PostManager {
    private $_db;

    function __construct($db) {
        $this->setDb($db);
    }

    public function setDb($db)
    {
       $this->_db = $db;
    }

// Method

    public function getPosts()
    {
        $sql = 'SELECT id, post_title, post_content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS post_date_fr FROM post ORDER BY post_date DESC LIMIT 0, 5';
        $stmt = $this->_db->prepare($sql);
        $posts = $stmt->execute();
        
        return $stmt;
    }

    public function getPost($post_id)
    {
        $sql = 'SELECT id, post_title, post_content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS post_date_fr FROM post WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($post_id));
        $post = $stmt->fetch();

        return $post;
    }
}