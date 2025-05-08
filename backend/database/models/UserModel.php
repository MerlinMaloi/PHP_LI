<?php

require_once __DIR__ . '/../db.php';

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = getDbConnection();
    }

    public function createUser($email, $password, $role = 'user')
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([$email, $hash, $role]);
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyPassword($email, $password)
    {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT id, email, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setAdminRole($userId)
    {
        $stmt = $this->db->prepare("UPDATE users SET role = 'admin' WHERE id = ?");
        return $stmt->execute([$userId]);
    }
}