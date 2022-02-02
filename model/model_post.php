<?php
// Model Post qui gérera tout ce qu se rapporte aux articles
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
    // Récupération des cinq derniers articles
    public function getPosts()
    {
        $sql = 'SELECT id, postTitle, postContent, DATE_FORMAT(postDate, \'%d/%m/%Y à %Hh%imin\') AS postDateFr FROM post ORDER BY postDate DESC LIMIT 0, 5';
        $stmt = $this->_db->prepare($sql);
        $posts = $stmt->execute();
        
        return $stmt;
    }
    // Récupération des titres des articles
    public function getTitles()
    {
        $sql = 'SELECT id, postTitle, DATE_FORMAT(postDate, \'%d/%m/%Y à %Hh%imin\') AS postDateFr FROM post ORDER BY postDate';
        $stmt = $this->_db->prepare($sql);
        $titles = $stmt->execute();

        return $stmt;
    }
    // Récupération d'un article en particulier
    public function getPost($postId)
    {
        $sql = 'SELECT id, postTitle, postContent, DATE_FORMAT(postDate, \'%d/%m/%Y à %Hh%imin\') AS postDateFr FROM post WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($postId));
        $post = $stmt->fetch();

        return $post;
    }
    // Récupération de tous les articles
    public function checkPost()
    {
        $sql = 'SELECT id, postTitle, postContent, DATE_FORMAT(postDate, \'%d/%m/%Y à %Hh%imin\') AS postDateFr FROM post ORDER BY postDate DESC';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array());
        $checkPost = $stmt;

        return $checkPost;
    }
    // Création d'un nouvel article
    public function newPost($postTitle, $postContent)
    {
        $sql = 'INSERT INTO post(postTitle, postContent, postDate) VALUES(?, ?, NOW())';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($postTitle, $postContent));
        $newPost = $stmt;

        return $newPost;
    }
    // Récupération du contenu d'un article
    public function modifyPost($id)
    {
        $sql = 'SELECT id, postTitle, postContent FROM post WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $modifiedPost = $stmt;

        return $modifiedPost;
    }
    // Envoi du contenu modifié d'un article
    public function updatePost($id, $newTitle, $newContent)
    {
        $sql = 'UPDATE post SET postTitle = :newTitle, postContent = :newContent WHERE id = :id';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array("id" => $id, "newTitle" => $newTitle, "newContent" => $newContent));
        $updatedPost = $stmt;

        return $updatedPost;
    }
    // Suppression d'un article
    public function deletePost($id)
    {
        $sql = 'DELETE FROM post WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $deletedPost = $stmt;

        return $deletedPost;
    }
}
