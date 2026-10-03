<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MajorController extends Controller
{
    public function index(Major $selected = null)
    {
        $majors = Major::orderBy('name')->get();
        $active = request('active')
            ? Major::find(request('active'))
            : $majors->first();

        return view('admin.majors.index', compact('majors', 'active'));
    }

    public function create()
    {
        return view('admin.majors.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['name']);
        $data['points'] = $this->buildPoints($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('majors', 'public');
        }

        Major::create($data);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Major $major)
    {
        return view('admin.majors.edit', compact('major'));
    }

    public function update(Request $request, Major $major)
    {
        $data = $this->validated($request, $major->id);
        $data['slug'] = Str::slug($data['name']);
        $data['points'] = $this->buildPoints($request);

        if ($request->hasFile('image')) {
            if ($major->image) {
                Storage::disk('public')->delete($major->image);
            }
            $data['image'] = $request->file('image')->store('majors', 'public');
        }

        $major->update($data);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Major $major)
    {
        if ($major->image) {
            Storage::disk('public')->delete($major->image);
        }
        $major->delete();

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil dihapus.');
    }

    protected function validated(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'point_title' => ['nullable', 'array'],
            'point_title.*' => ['nullable', 'string', 'max:100'],
            'point_desc' => ['nullable', 'array'],
            'point_desc.*' => ['nullable', 'string', 'max:255'],
        ]);
    }

    protected function buildPoints(Request $request): array
    {
        $titles = $request->input('point_title', []);
        $descs = $request->input('point_desc', []);
        $points = [];

        foreach ($titles as $i => $title) {
            $title = trim($title ?? '');
            $desc = trim($descs[$i] ?? '');
            if ($title !== '') {
                $points[$title] = $desc;
            }
        }

        return $points;
    }
}