<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display the manager dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // You can pass statistics or relevant data to the view if needed
        return view('manager.dashboard');
    }
}
