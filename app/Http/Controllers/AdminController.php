<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('admin.index', compact('teams'));
    }
}
