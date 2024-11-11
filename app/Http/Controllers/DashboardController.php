<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /// In your Controller (DashboardController.php)
public function index()
{
    $user = auth()->user(); // Get the logged-in user
    return view('dashboard', ['user' => $user]);
}

}
