<?php
class User {
    private $_id;
    private $_user_name;
    private $_password;
    private $_e_mail;
    private $_first_name;
    private $_last_name;

// Constructeur

    function __construct($user_name, $password, $e_mail, $first_name, $last_name) {
        $this->_user_name = $user_name;
        $this->_password = $password;
        $this->_e_mail = $e_mail;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
    }

// Getters

    public function id() {
        return $this->_id;
    }

    public function user_name() {
        return $this->_user_name;
    }

    public function password() {
        return $this->_password;
    }

    public function e_mail() {
        return $this->_e_mail;
    }

    public function first_name() {
        return $this->_first_name;
    }

    public function last_name() {
        return $this->_last_name;
    }

// Setters

    public function setId() {
        $this->_id = $id;
    }

    public function setUserName($user_name) {
        $this->_user_name = $user_name;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function setEmail($e_mail) {
        $this->_e_mail = $e_mail;
    }

    public function setFirstName($first_name) {
        $this->_first_name = $first_name;
    }

    public function setLastName($last_name) {
        $this->_last_name = $last_name;
    }

// Hydrate

    public function hydrate(array $data)
    {
        if (isset($data['id']))
        {
        $this->setId($data['id']);
        }

        if (isset($data['user_name']))
        {
            $this->setUserName($data['user_name']);
        }

        if (isset($data['password']))
        {
            $this->setPassword($data['password']);
        }

        if (isset($data['e_mail']))
        {
            $this->setEmail($data['e_mail']);
        }

        if (isset($data['first_name']))
        {
            $this->setFirstName($data['first_name']);
        }

        if (isset($data['last_name']))
        {
            $this->setLastName($data['last_name']);
        }
    }
}

class UserManager {

    private $_db;

    function __construct($db) {
        $this->setDb($db);
    }

    public function setDb($db)
    {
       $this->_db = $db;
    }

// Method

    public function checkUser($user_name) {
        $sql = "SELECT user_name FROM user WHERE user_name=?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$user_name]);
        $result = $stmt->fetch();
        return $result;
    }

    public function checkEmail($e_mail) {
        $sql = "SELECT e_mail FROM user WHERE e_mail=?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$e_mail]);
        $result = $stmt->fetch();
        return $result;
    }

    public function signIn($user_name, $pass_hash, $e_mail, $first_name, $last_name) {
        $sql = "INSERT INTO user(user_name, first_name, last_name, e_mail, password, function) VALUES(:user_name, :first_name, :last_name, :e_mail, :pass_hash, 'user')";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':pass_hash', $pass_hash);
        $stmt->bindParam(':e_mail', $e_mail);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $result = $stmt->execute();
        return $result;
    }

    public function getUser($user_name) {
        $sql = "SELECT user_name FROM user WHERE user_name = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$user_name]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getPassHash($user_name) {
        $sql = "SELECT password FROM user WHERE user_name = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$user_name]);
        $result = $stmt->fetch();
        return $result;
    }
}