<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Spesies;
use App\Ordo;

class DashboardController extends Controller
{
    public function index()
    {
        $member = User::where('role',1)->count();
        $spesies = Spesies::count();
        $ordo = Ordo::count();
        return view('dashboard.index',compact('member','spesies','ordo'));
    }
}
