<?
class Admin {
    private $id;
    // Constructeur

function __construct($id) {
    $this->_id = $id;
}

// Getter

public function id() {
    return $this->_id;
}

// Setter

public function setId() {
    $this->_id = $id;
}

// Hydrate

public function hydrate(array $data)
    {
        if (isset($data['id']))
        {
            $this->setId($data['id']);
        }
    }
}

class AdminManager {
    private $_db;

    function __construct($db) {
        $this->setDb($db);
    }

    public function setDb($db)
    {
       $this->_db = $db;
    }

// Method

    // Post

    function checkPost()
    {
        $sql = 'SELECT id, post_title, post_content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS post_date_fr FROM post ORDER BY post_date';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array());
        $check_post = $stmt->fetch();

        return $check_post;
    }

    function newPost()
    {

    }

    function modifyPost($id)
    {
        $sql = 'UPDATE post SET post_title = :new_title, post_content = :new_post_content WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $modified_post = $stmt->fetch();

        return $modified_post;
    }

    function deletePost($id)
    {
        $sql = 'DELETE FROM post WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $deleted_post = $stmt->fetch();

        return $deleted_post;
    }

    // Comment

    function checkComment()
    {
        $sql = 'SELECT id, post_id, user_name, comment_content, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comment WHERE comment_status = \'Alert\' ORDER BY comment_date DESC';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array());
        $check_comment = $stmt->fetch();

        return $check_comment;
    }

    function clearComment($id)
    {
        $sql = 'UPDATE comment SET comment_status = \'Ok\' WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $cleared_comment = $stmt->fetch();

        return $cleared_comment;
    }

    function deletComment($id)
    {
        $sql = 'DELETE FROM comment WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $deleted_comment = $stmt->fetch();

        return $deleted_comment;
    }

    // User

    function checkUser()
    {
        $sql = "SELECT * FROM user";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array());
        $check_user = $stmt->fetch();

        return $check_user;
    }

    function modifyUser($id)
    {
        $sql = 'UPDATE user SET first_name = :new_first_name, last_name = :new_last_name, e_mail = :new_e_mail, password = :new_password WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $modified_user = $stmt->fetch();

        return $modified_user;
    }

    function deleteUser($user_name)
    {
        $sql = 'DELETE FROM user WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $deleted_user = $stmt->fetch();

        return $deleted_user;
    }
}