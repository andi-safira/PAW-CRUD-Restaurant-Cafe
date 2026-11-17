<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Read: display all menu items
    public function index()
    {
        $menus = Menu::all();

        return view('menu.index', compact('menus'));
    }

    // Show the add form
    public function create()
    {
        return view('menu.form');
    }

    // Create: save a new menu item
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:250',
            'kategori' => 'required|string|max:250',
            'harga' => 'required|integer|min:0',
            'alergen' => 'required|string|max:250',
            'halal' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:250',
        ]);

        Menu::create($data);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    // Show the edit form
    public function edit(Menu $menu)
    {
        return view('menu.form', compact('menu'));
    }

    // Update: save changes
    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:250',
            'kategori' => 'required|string|max:250',
            'harga' => 'required|integer|min:0',
            'alergen' => 'required|string|max:250',
            'halal' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:250',
        ]);

        $menu->update($data);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil diperbarui!');
    }

    // Delete: remove a menu item
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil dihapus!');
    }
}