<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('ordre')->paginate(20);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ordre' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $request->file('image')->store('banners', 'public');

        Banner::create([
            'image_path' => $imagePath,
            'ordre' => $request->ordre ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Bannière créée avec succès !');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ordre' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($banner->image_path);
            $banner->image_path = $request->file('image')->store('banners', 'public');
        }

        $banner->update([
            'ordre' => $request->ordre ?? $banner->ordre,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Bannière mise à jour !');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Bannière supprimée !');
    }
}