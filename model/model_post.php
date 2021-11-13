<?php
class Post
{
    private $id;
    private $postTitle;
    private $postContent;
    private $postDate;

    // Constructeur

    public function __construct($postTitle, $postContent, $postDate)
    {
        $this->_postTitle = $postTitle;
        $this->_postContent = $postContent;
        $this->_postDate = $postDate;
    }

    // Getter

    public function id()
    {
        return $this->_id;
    }

    public function postTitle()
    {
        return $this->_postTitle;
    }

    public function postContent()
    {
        return $this->_postContent;
    }

    public function postDate()
    {
        return $this->_postDate;
    }

    // Setter

    public function setId()
    {
        $this->_id = $id;
    }

    public function setPostTitle($postTitle)
    {
        $this->_postTitle = $postTitle;
    }

    public function setPostContent($postContent)
    {
        $this->_postContent = $postContent;
    }

    public function setPostDate($postDate)
    {
        $this->_postDate = $postDate;
    }

    // Hydrate

    public function hydrate(array $data)
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['postTitle'])) {
            $this->setPostTitle($data['postTitle']);
        }

        if (isset($data['postContent'])) {
            $this->setPostContent($data['postContent']);
        }

        if (isset($data['postDate'])) {
            $this->setPostDate($data['postDate']);
        }
    }
}

class PostManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb($db)
    {
        $this->_db = $db;
    }

    // Method

    public function getPosts()
    {
        $sql = 'SELECT id, postTitle, postContent, DATE_FORMAT(postDate, \'%d/%m/%Y à %Hh%imin\') AS postDateFr FROM post ORDER BY postDate DESC LIMIT 0, 5';
        $stmt = $this->_db->prepare($sql);
        $posts = $stmt->execute();
        
        return $stmt;
    }

    public function getTitles()
    {
        $sql = 'SELECT id, postTitle, DATE_FORMAT(postDate, \'%d/%m/%Y à %Hh%imin\') AS postDateFr FROM post ORDER BY postDate';
        $stmt = $this->_db->prepare($sql);
        $titles = $stmt->execute();

        return $stmt;
    }

    public function getPost($postId)
    {
        $sql = 'SELECT id, postTitle, postContent, DATE_FORMAT(postDate, \'%d/%m/%Y à %Hh%imin\') AS postDateFr FROM post WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($postId));
        $post = $stmt->fetch();

        return $post;
    }

    public function checkPost()
    {
        $sql = 'SELECT id, postTitle, postContent, DATE_FORMAT(postDate, \'%d/%m/%Y à %Hh%imin\') AS postDateFr FROM post ORDER BY postDate DESC';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array());
        $checkPost = $stmt;

        return $checkPost;
    }

    public function newPost($postTitle, $postContent)
    {
        $sql = 'INSERT INTO post(postTitle, postContent, postDate) VALUES(?, ?, NOW())';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($postTitle, $postContent));
        $newPost = $stmt;

        return $newPost;
    }

    public function modifyPost($id)
    {
        $sql = 'SELECT id, postTitle, postContent FROM post WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $modifiedPost = $stmt;

        return $modifiedPost;
    }

    public function updatePost($id, $newTitle, $newContent)
    {
        $sql = 'UPDATE post SET postTitle = :newTitle, postContent = :newContent WHERE id = :id';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array("id" => $id, "newTitle" => $newTitle, "newContent" => $newContent));
        $updatedPost = $stmt;

        return $updatedPost;
    }

    public function deletePost($id)
    {
        $sql = 'DELETE FROM post WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $deletedPost = $stmt;

        return $deletedPost;
    }
}
