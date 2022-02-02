<?php
// Model User qui gérera tout ce qui se rapporte aux utilisateurs
class User
{
    private $_id;
    private $_userName;
    private $_password;
    private $_eMail;
    private $_firstName;
    private $_lastName;

    // Constructeur

    public function __construct($userName, $password, $eMail, $firstName, $lastName)
    {
        $this->_userName = $userName;
        $this->_password = $password;
        $this->_eMail = $eMail;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
    }

    // Getters

    public function id()
    {
        return $this->_id;
    }

    public function userName()
    {
        return $this->_userName;
    }

    public function password()
    {
        return $this->_password;
    }

    public function eMail()
    {
        return $this->_eMail;
    }

    public function firstName()
    {
        return $this->_firstName;
    }

    public function lastName()
    {
        return $this->_lastName;
    }

    // Setters

    public function setId()
    {
        $this->_id = $id;
    }

    public function setUserName($userName)
    {
        $this->_userName = $userName;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function setEmail($eMail)
    {
        $this->_eMail = $eMail;
    }

    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    // Hydrate

    public function hydrate(array $data)
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['userName'])) {
            $this->setUserName($data['userName']);
        }

        if (isset($data['password'])) {
            $this->setPassword($data['password']);
        }

        if (isset($data['eMail'])) {
            $this->setEmail($data['eMail']);
        }

        if (isset($data['firstName'])) {
            $this->setFirstName($data['firstName']);
        }

        if (isset($data['lastName'])) {
            $this->setLastName($data['lastName']);
        }
    }
}

class UserManager
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
    // Enregistrement d'un nouvel utilisateur
    public function signIn($userName, $passHash, $eMail, $firstName, $lastName)
    {
        $sql = "INSERT INTO user(userName, firstName, lastName, eMail, password, function) VALUES(:userName, :firstName, :lastName, :eMail, :passHash, 'user')";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':passHash', $passHash);
        $stmt->bindParam(':eMail', $eMail);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $result = $stmt->execute();
        return $result;
    }
    // Récupération des informations de tous les utilisateurs
    public function checkUsers()
    {
        $sql = "SELECT * FROM user";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array());
        $checkUsers = $stmt;

        return $checkUsers;
    }
    // Récupération des informations d'un utilisateur
    public function getInfo($userName)
    {
        $sql = "SELECT * FROM user WHERE userName = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$userName]);
        $result = $stmt->fetch();

        return $result;
    }
    // Suppression d'un utilisateur
    public function deleteUser($id)
    {
        $sql = 'DELETE FROM user WHERE id = ?';
        $stmt = $this->_db->prepare($sql);
        $stmt->execute(array($id));
        $deletedUser = $stmt;

        return $deletedUser;
    }
}
