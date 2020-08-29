<?php

namespace App\Http\Controllers;

use Facades\App\Repositories\facades\UserRepository;
use Illuminate\Http\Request;
class PageController extends Controller
{
    public function index()
    {
        $repo = new UserRepository();
        return view('welcome', [
            'users' => $repo->latest()
        ]);
    }
}
