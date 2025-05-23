<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // If you want to restrict to admin role, uncomment the line below
        // $this->middleware('role:admin');
    }
    
    public function dashboard()
    {
        // Get counts for dashboard
        $userCount = User::count();
        
        // Get recent users with their roles
        $recentUsers = User::with('roles')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get role statistics
        $roleStats = Role::withCount('users')->get();
        
        // You can add more statistics as needed
        $movieCount = 0; //Replace with actual counts
        $cinemaCount = 0; 
        $bookingCount = 0; 
        
        return view('admin.dashboard', compact(
            'userCount', 
            'recentUsers', 
            'roleStats',
            'movieCount',
            'cinemaCount',
            'bookingCount'
        ));
    }
}