<?php
class Comment
{
    private $id;
    private $postId;
    private $userId;
    private $commentContent;
    private $commentDate;

    // Constructeur

    public function __construct($postId, $userId, $commentContent, $commentDate)
    {
        $this->_postId = $postId;
        $this->_userId = $userId;
        $this->_commentContent = $commentContent;
        $this->_commentDate = $commentDate;
    }

    // Getter

    public function id()
    {
        return $this->_id;
    }

    public function postId()
    {
        return $this->_postId;
    }

    public function userId()
    {
        return $this->_userId;
    }

    public function commentContent()
    {
        return $this->_commentContent;
    }

    public function commentDate()
    {
        return $this->_commentDate;
    }

    // Setter

    public function setId()
    {
        $this->_id = $id;
    }

    public function setPostId($postId)
    {
        $this->_postId = $postId;
    }

    public function setUserId($userId)
    {
        $this->_userId = $userId;
    }

    public function setCommentContent($commentContent)
    {
        $this->_commentContent = $commentContent;
    }

    public function setCommentDate($commentDate)
    {
        $this->_commentDate = $commentDate;
    }

    // Hydrate

    public function hydrate(array $data)
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['postId'])) {
            $this->setPostId($data['postId']);
        }

        if (isset($data['userId'])) {
            $this->setUserId($data['userId']);
        }

        if (isset($data['commentContent'])) {
            $this->setCommentContent($data['commentContent']);
        }

        if (isset($data['commentDate'])) {
            $this->setCommentDate($data['commentDate']);
        }
    }
}

class CommentManager
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

    public function getComments($postId)
    {
        $sql = 'SELECT id, postId, userName, commentContent, DATE_FORMAT(commentDate, \'%d/%m/%Y à %Hh%imin\') AS commentDateFr FROM comment WHERE postId = ? AND commentStatus = \'Ok\' ORDER BY commentDate DESC';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($postId));
        $comments = $stmt;

        return $comments;
    }

    public function addComment($postId, $userName, $commentContent)
    {
        $sql = 'INSERT INTO comment(postId, userName, commentContent, commentDate) VALUES(?, ?, ?, NOW())';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($postId, $userName, $commentContent));
        $affectedLines = $stmt;

        return $affectedLines;
    }

    public function checkComment()
    {
        $sql = 'SELECT id, postId, userName, commentContent, DATE_FORMAT(commentDate, \'%d/%m/%Y à %Hh%imin\') AS commentDateFr FROM comment WHERE commentStatus = \'Alert\' ORDER BY commentDate DESC';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array());
        $checkComment = $stmt;

        return $checkComment;
    }

    public function alertComment($id)
    {
        $sql ='UPDATE comment SET commentStatus = \'Alert\' WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $alertedComment = $stmt;

        return $alertedComment;
    }

    public function clearComment($id)
    {
        $sql = 'UPDATE comment SET commentStatus = \'Ok\' WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $clearedComment = $stmt;

        return $clearedComment;
    }
    
    public function deleteComment($id)
    {
        $sql = 'DELETE FROM comment WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $deletedComment = $stmt;

        return $deletedComment;
    }

    public function deleteAllComment($id)
    {
        $sql = 'DELETE FROM comment WHERE postId = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $deletedAllComment = $stmt;

        return $deletedAllComment;
    }
}
