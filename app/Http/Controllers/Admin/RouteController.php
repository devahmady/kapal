<?php

namespace App\Http\Controllers\Admin;

use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Transportation;

class RouteController extends Controller
{
    // Menampilkan daftar semua rute
    public function index()
    {
        $routes = Route::all(); // Mengambil semua data rute
        return view('admin.routes.index', compact('routes')); // Menampilkan ke view 'routes.index'
    }

    // Menampilkan form untuk membuat rute baru
    public function create()
    {
        $data['transpor'] = Transportation::all();
        return view('admin.routes.create', $data); // Menampilkan ke view 'routes.create'
    }

    // Menyimpan rute baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'start_point' => 'required|string|max:255',
            'end_point' => 'required|string|max:255',
            'jam' => 'required',
            'transportation_id' => 'nullable',
        ]);

        Route::create($request->all()); // Menyimpan data rute baru
        return redirect()->route('route.index')->with('success', 'Route created successfully.');
    }

    // Menampilkan form untuk mengedit rute yang ada
    public function edit($id)
    {
        $data['route'] = Route::findOrFail($id);
        return view('admin.routes.edit', $data); // Menampilkan ke view 'routes.edit'
    }

    // Memperbarui rute yang ada di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_point' => 'required|string|max:255',
            'end_point' => 'required|string|max:255',
            'jam' => 'required',
            'transportation_id' => 'nullable',
        ]);

        $route = Route::findOrFail($id);
        $route->update($request->all());

        return redirect()->route('route.index')->with('success', 'Route updated successfully');
    }
    
    


    // Menghapus rute dari database
    public function destroy($id)
    {
        $route = Route::findOrFail($id); // Menemukan rute berdasarkan ID atau melemparkan 404 jika tidak ditemukan
        Route::destroy($route->id);
        return redirect()->route('route.index')->with('success', 'Route deleted successfully.');
    }
}
