<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Major;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('frontend.user-dashboard', [
            'majors' => Major::orderBy('name')->get(),
            'informations' => Information::latest()->get(),
        ]);
    }
}
