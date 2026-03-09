<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::latest()->get();
        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:100',
            'image'    => 'required|image|mimes:jpg,jpeg,png,webp|max:512', // max 512KB
            'url'      => 'nullable|url',
            'position' => 'required|in:in_content,footer_sticky',
            'pages'    => 'required|array|min:1',
        ]);

        $path = $request->file('image')->store('ads', 'public');

        Ad::create([
            'title'     => $request->title,
            'image'     => $path,
            'url'       => $request->url,
            'position'  => $request->position,
            'pages'     => $request->pages,
            'is_active' => true,
        ]);

        return redirect()->route('admin.ads.index')
            ->with('success', 'Iklan berhasil ditambahkan.');
    }

    public function toggle(Ad $ad)
    {
        $ad->update(['is_active' => !$ad->is_active]);

        return back()->with('success', 'Status iklan diperbarui.');
    }

    public function destroy(Ad $ad)
    {
        Storage::disk('public')->delete($ad->image);
        $ad->delete();

        return back()->with('success', 'Iklan berhasil dihapus.');
    }
}