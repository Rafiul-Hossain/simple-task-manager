<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Get task statistics
        $totalTasks = Task::where('user_id', $user->id)->count();
        $pendingTasks = Task::where('user_id', $user->id)->where('status', 'Pending')->count();
        $inProgressTasks = Task::where('user_id', $user->id)->where('status', 'In Progress')->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', 'Completed')->count();
        
        // Get recent tasks (last 5)
        $recentTasks = Task::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('home', compact(
            'totalTasks',
            'pendingTasks', 
            'inProgressTasks',
            'completedTasks',
            'recentTasks'
        ));
    }
}
