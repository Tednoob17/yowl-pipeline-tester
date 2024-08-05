<?php

namespace App\Http\Controllers;

use App\Models\Browser as ModelsBrowser;
use App\Models\Comment;
use App\Models\User;
use Browser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatController extends Controller
{
    public function index()
    {
        $user_count = User::count();

        $comment_counts = Comment::count();

        // get the number of comments per user average
        $average_comments_per_user = $comment_counts / $user_count;

        // get average time before new user comments
        $average_time_before_comment = Comment::avg('created_at');

        // get the most common browser
        $most_common_browser = ModelsBrowser::select('name')
            ->groupBy('name')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        return Inertia::render('Dashboard', [
            "stats" => [
                "user_count" => $user_count,
                "comment_counts" => $comment_counts,
                "average_comments_per_user" => $average_comments_per_user,
                "average_time_before_comment" => $average_time_before_comment,
                "most_common_browser" => $most_common_browser
            ]
        ]);
    }
}
