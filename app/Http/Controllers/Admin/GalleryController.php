<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Models\Major;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public const CATEGORIES = ['Kegiatan', 'Prestasi', 'Fasilitas', 'Ekstrakurikuler', 'Lainnya'];

    public function index(Request $request)
    {
        $query = Gallery::with('major')->latest();

        $activeMajor = null;
        if ($request->filled('major_id')) {
            $activeMajor = Major::find($request->major_id);
            $query->where('major_id', $request->major_id);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->get();
        $majors = Major::orderBy('name')->get();

        return view('admin.galleries.index', [
            'galleries' => $galleries,
            'majors' => $majors,
            'activeMajor' => $activeMajor,
            'categories' => self::CATEGORIES,
            'activeCategory' => $request->category,
        ]);
    }

    public function create(Request $request)
    {
        $majors = Major::orderBy('name')->get();
        $selectedMajorId = $request->integer('major_id') ?: null;

        return view('admin.galleries.create', [
            'majors' => $majors,
            'selectedMajorId' => $selectedMajorId,
            'categories' => self::CATEGORIES,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'major_id' => ['nullable', 'exists:majors,id'],
            'category' => ['nullable', 'string', 'max:50'],
            'caption' => ['nullable', 'string', 'max:150'],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $data['image'] = $request->file('image')->store('galleries', 'public');

        Gallery::create($data);

        return redirect()
            ->route('admin.galleries.index', array_filter(['major_id' => $data['major_id'] ?? null]))
            ->with('success', 'Foto berhasil ditambahkan ke galeri. Otomatis muncul di halaman jurusan pada frontend.');
    }

    public function edit(Gallery $gallery)
    {
        $majors = Major::orderBy('name')->get();

        return view('admin.galleries.edit', [
            'gallery' => $gallery,
            'majors' => $majors,
            'categories' => self::CATEGORIES,
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'major_id' => ['nullable', 'exists:majors,id'],
            'category' => ['nullable', 'string', 'max:50'],
            'caption' => ['nullable', 'string', 'max:150'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.galleries.index', array_filter(['major_id' => $gallery->major_id]))
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $majorId = $gallery->major_id;
        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index', array_filter(['major_id' => $majorId]))
            ->with('success', 'Foto berhasil dihapus.');
    }
}