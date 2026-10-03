<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Information;
use App\Models\Major;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'informationCount' => Information::count(),
            'majorCount' => Major::count(),
            'galleryCount' => Gallery::count(),
            'messageCount' => ContactMessage::count(),
            'informations' => Information::latest()->take(5)->get(),
        ]);
    }
}
