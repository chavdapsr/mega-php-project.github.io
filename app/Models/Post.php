<?php

namespace App\Models;

use App\Core\Database;

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create($data)
    {
        $sql = "INSERT INTO posts (user_id, title, content, created_at) 
                VALUES (:user_id, :title, :content, NOW())";
        
        $params = [
            ':user_id' => $data['user_id'],
            ':title' => $data['title'],
            ':content' => $data['content']
        ];

        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }

    public function findById($id)
    {
        $sql = "SELECT p.*, u.username 
                FROM posts p 
                LEFT JOIN users u ON p.user_id = u.id 
                WHERE p.id = :id";
        return $this->db->fetchOne($sql, [':id' => $id]);
    }

    public function getAll($limit = null, $offset = 0)
    {
        $sql = "SELECT p.*, u.username 
                FROM posts p 
                LEFT JOIN users u ON p.user_id = u.id 
                ORDER BY p.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT :limit OFFSET :offset";
            return $this->db->fetchAll($sql, [':limit' => $limit, ':offset' => $offset]);
        }
        
        return $this->db->fetchAll($sql);
    }

    public function getByUserId($userId)
    {
        $sql = "SELECT p.*, u.username 
                FROM posts p 
                LEFT JOIN users u ON p.user_id = u.id 
                WHERE p.user_id = :user_id 
                ORDER BY p.created_at DESC";
        return $this->db->fetchAll($sql, [':user_id' => $userId]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $params = [
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':id' => $id
        ];
        return $this->db->query($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM posts WHERE id = :id";
        return $this->db->query($sql, [':id' => $id]);
    }

    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM posts";
        $result = $this->db->fetchOne($sql);
        return $result['total'] ?? 0;
    }
}
