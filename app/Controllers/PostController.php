<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Models\Post;

class PostController extends Controller
{
    private $postModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = new Post();
    }

    public function index()
    {
        $posts = $this->postModel->getAll();
        $this->view('posts/index', [
            'posts' => $posts,
            'user' => Auth::user()
        ]);
    }

    public function show($id)
    {
        $post = $this->postModel->findById($id[0]);
        
        if (!$post) {
            Session::flash('error', 'Post not found');
            $this->redirect('/posts');
        }

        $this->view('posts/show', [
            'post' => $post,
            'user' => Auth::user(),
            'csrf_token' => $this->generateCsrfToken()
        ]);
    }

    public function create()
    {
        Auth::requireAuth();
        $this->view('posts/create', [
            'csrf_token' => $this->generateCsrfToken(),
            'user' => Auth::user()
        ]);
    }

    public function store()
    {
        Auth::requireAuth();
        $this->validateCsrf();

        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if (empty($title) || empty($content)) {
            Session::flash('error', 'Title and content are required');
            $this->redirect('/posts/create');
        }

        $postId = $this->postModel->create([
            'user_id' => Auth::id(),
            'title' => $title,
            'content' => $content
        ]);

        Session::flash('success', 'Post created successfully!');
        $this->redirect('/posts/' . $postId);
    }

    public function edit($id)
    {
        Auth::requireAuth();
        
        $post = $this->postModel->findById($id[0]);
        
        if (!$post) {
            Session::flash('error', 'Post not found');
            $this->redirect('/posts');
        }

        if ($post['user_id'] != Auth::id()) {
            Session::flash('error', 'You can only edit your own posts');
            $this->redirect('/posts');
        }

        $this->view('posts/edit', [
            'post' => $post,
            'csrf_token' => $this->generateCsrfToken(),
            'user' => Auth::user()
        ]);
    }

    public function update($id)
    {
        Auth::requireAuth();
        $this->validateCsrf();

        $post = $this->postModel->findById($id[0]);
        
        if (!$post) {
            Session::flash('error', 'Post not found');
            $this->redirect('/posts');
        }

        if ($post['user_id'] != Auth::id()) {
            Session::flash('error', 'You can only edit your own posts');
            $this->redirect('/posts');
        }

        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if (empty($title) || empty($content)) {
            Session::flash('error', 'Title and content are required');
            $this->redirect('/posts/' . $id[0] . '/edit');
        }

        $this->postModel->update($id[0], [
            'title' => $title,
            'content' => $content
        ]);

        Session::flash('success', 'Post updated successfully!');
        $this->redirect('/posts/' . $id[0]);
    }

    public function delete($id)
    {
        Auth::requireAuth();
        $this->validateCsrf();

        $post = $this->postModel->findById($id[0]);
        
        if (!$post) {
            Session::flash('error', 'Post not found');
            $this->redirect('/posts');
        }

        if ($post['user_id'] != Auth::id()) {
            Session::flash('error', 'You can only delete your own posts');
            $this->redirect('/posts');
        }

        $this->postModel->delete($id[0]);
        Session::flash('success', 'Post deleted successfully!');
        $this->redirect('/posts');
    }
}
