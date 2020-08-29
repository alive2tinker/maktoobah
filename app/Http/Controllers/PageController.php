<?php

namespace App\Http\Controllers;

use Facades\App\Repositories\facades\UserRepository;
use Illuminate\Http\Request;
class PageController extends Controller
{
    public function index()
    {
        $users = UserRepository::latest();
        return view('welcome', [
            'users' => $users
        ]);
    }
}
