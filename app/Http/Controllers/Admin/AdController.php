<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        $ads = Advertisement::latest()->paginate(15);

        $stats = [
            'total'       => Advertisement::count(),
            'active'      => Advertisement::active()->count(),
            'total_clicks'=> Advertisement::sum('click_count'),
            'total_impr'  => Advertisement::sum('impression_count'),
        ];

        return view('admin.ads.index', compact('ads', 'stats'));
    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'url'       => 'nullable|url|max:500',
            'position'  => 'required|in:footer_sticky,in_content',
            'pages'     => 'nullable|array',
            'pages.*'   => 'string|in:all,home,quran,shalat,quran_tracking,prayer_tracking,tasbih,doa,asmaul_husna,qibla',
            'is_active' => 'boolean',
            'starts_at' => 'nullable|date',
            'ends_at'   => 'nullable|date|after_or_equal:starts_at',
        ]);

        // Upload gambar
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')
                ->store('ads', 'public');
        }

        // Pages: kalau pilih 'all' atau kosong → simpan null
        if (empty($validated['pages']) || in_array('all', $validated['pages'] ?? [])) {
            $validated['pages'] = null;
        }

        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active', true);

        Advertisement::create($validated);

        return redirect()->route('admin.ads.index')
            ->with('success', 'Iklan berhasil dibuat!');
    }

    public function edit(Advertisement $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(Request $request, Advertisement $ad)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'url'       => 'nullable|url|max:500',
            'position'  => 'required|in:footer_sticky,in_content',
            'pages'     => 'nullable|array',
            'pages.*'   => 'string',
            'is_active' => 'boolean',
            'starts_at' => 'nullable|date',
            'ends_at'   => 'nullable|date|after_or_equal:starts_at',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($ad->image_path) {
                Storage::disk('public')->delete($ad->image_path);
            }
            $validated['image_path'] = $request->file('image')
                ->store('ads', 'public');
        }

        if (empty($validated['pages']) || in_array('all', $validated['pages'] ?? [])) {
            $validated['pages'] = null;
        }

        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active', false);

        $ad->update($validated);

        return redirect()->route('admin.ads.index')
            ->with('success', 'Iklan berhasil diupdate!');
    }

    public function destroy(Advertisement $ad)
    {
        if ($ad->image_path) {
            Storage::disk('public')->delete($ad->image_path);
        }

        $ad->delete();

        return redirect()->route('admin.ads.index')
            ->with('success', 'Iklan berhasil dihapus.');
    }

    /**
     * Toggle aktif/nonaktif via AJAX.
     */
    public function toggle(Advertisement $ad)
    {
        $ad->update(['is_active' => !$ad->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $ad->is_active,
            'label'     => $ad->is_active ? 'Aktif' : 'Nonaktif',
        ]);
    }

    /**
     * Record click (dipanggil dari frontend saat iklan diklik).
     */
    public function click(Advertisement $ad)
    {
        $ad->recordClick();

        return response()->json(['success' => true]);
    }
}