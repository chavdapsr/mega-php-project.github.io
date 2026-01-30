<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/index', [
            'user' => Auth::user()
        ]);
    }
}
