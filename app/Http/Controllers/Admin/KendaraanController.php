<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Tiket;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::with('tiket')->get();
        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        $tiket = Tiket::where('name', 'Kendaraan')->get();
        return view('admin.kendaraan.create', compact('tiket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'ticket_type_id' => 'required|exists:tikets,id',
        ]);

        Kendaraan::create($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $tiket = Tiket::where('name', 'Kendaraan')->get();
        return view('admin.kendaraan.edit', compact('kendaraan', 'tiket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'plat' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'ticket_type_id' => 'required|exists:tikets,id',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy($id)
    {
        Kendaraan::destroy($id);

        return redirect()->route('kendaraan.index')->with('success', 'Vehicle deleted successfully.');
    }
}
