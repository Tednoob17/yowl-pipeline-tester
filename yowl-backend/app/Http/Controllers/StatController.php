<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $user_count = User::count();

        $comment_counts = Comment::count();

        
    }
}
