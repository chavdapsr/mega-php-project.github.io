<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Post;
use App\Models\User;

class ApiController extends Controller
{
    private $postModel;
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = new Post();
        $this->userModel = new User();
    }

    public function posts()
    {
        $posts = $this->postModel->getAll();
        $this->json(['success' => true, 'data' => $posts]);
    }

    public function post($id)
    {
        $post = $this->postModel->findById($id[0]);
        
        if (!$post) {
            $this->json(['success' => false, 'message' => 'Post not found'], 404);
        }

        $this->json(['success' => true, 'data' => $post]);
    }

    public function createPost()
    {
        Auth::requireAuth();

        $data = json_decode(file_get_contents('php://input'), true);
        
        if (empty($data['title']) || empty($data['content'])) {
            $this->json(['success' => false, 'message' => 'Title and content are required'], 400);
        }

        $postId = $this->postModel->create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'content' => $data['content']
        ]);

        $post = $this->postModel->findById($postId);
        $this->json(['success' => true, 'data' => $post], 201);
    }

    public function users()
    {
        $users = $this->userModel->getAll();
        $this->json(['success' => true, 'data' => $users]);
    }

    public function user($id)
    {
        $user = $this->userModel->findById($id[0]);
        
        if (!$user) {
            $this->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $this->json(['success' => true, 'data' => $user]);
    }
}
