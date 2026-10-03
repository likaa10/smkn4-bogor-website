<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::latest()->get();
        return view('admin.informations.index', compact('informations'));
    }

    public function create()
    {
        return view('admin.informations.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('informations', 'public');
        }

        Information::create($data);

        return redirect()->route('admin.informations.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit(Information $information)
    {
        return view('admin.informations.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            if ($information->image) {
                Storage::disk('public')->delete($information->image);
            }
            $data['image'] = $request->file('image')->store('informations', 'public');
        }

        $information->update($data);

        return redirect()->route('admin.informations.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy(Information $information)
    {
        if ($information->image) {
            Storage::disk('public')->delete($information->image);
        }
        $information->delete();

        return redirect()->route('admin.informations.index')->with('success', 'Informasi berhasil dihapus.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
