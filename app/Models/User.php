<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create($data)
    {
        $sql = "INSERT INTO users (username, email, password, created_at) 
                VALUES (:username, :email, :password, NOW())";
        
        $params = [
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ];

        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        return $this->db->fetchOne($sql, [':email' => $email]);
    }

    public function findById($id)
    {
        $sql = "SELECT id, username, email, created_at FROM users WHERE id = :id";
        return $this->db->fetchOne($sql, [':id' => $id]);
    }

    public function findByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        return $this->db->fetchOne($sql, [':username' => $username]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
        $params = [
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':id' => $id
        ];
        return $this->db->query($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        return $this->db->query($sql, [':id' => $id]);
    }

    public function getAll()
    {
        $sql = "SELECT id, username, email, created_at FROM users ORDER BY created_at DESC";
        return $this->db->fetchAll($sql);
    }
}
