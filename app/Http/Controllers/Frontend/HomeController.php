<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Information;
use App\Models\Major;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home', [
            'majors' => Major::orderBy('name')->get(),
            'informations' => Information::latest()->take(3)->get(),
        ]);
    }

    public function showMajor(Major $major)
    {
        return view('frontend.major', [
            'major' => $major,
            'galleries' => $major->galleries()->latest()->get(),
        ]);
    }

    public function gallery(Request $request)
    {
        $query = Gallery::with('major')->latest();

        if ($request->filled('major')) {
            $query->whereHas('major', fn ($q) => $q->where('slug', $request->major));
        }

        return view('frontend.gallery', [
            'galleries' => $query->get(),
            'majors' => Major::orderBy('name')->get(),
        ]);
    }

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'message' => ['required', 'string'],
        ]);

        ContactMessage::create($data);

        return back()->with('success', 'Pesan Anda berhasil dikirim. Terima kasih!');
    }
}