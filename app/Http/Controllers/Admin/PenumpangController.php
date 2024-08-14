<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penumpang;
use App\Models\Tiket;
use Illuminate\Http\Request;

class PenumpangController extends Controller
{
    public function index()
    {
        $penumpang = Penumpang::with('tiket')->get();
        return view('admin.penumpang.index', compact('penumpang'));
    }

    public function create()
    {
        $tiket = Tiket::where('name', 'Penumpang')->get();
        return view('admin.penumpang.create', compact('tiket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level' => 'nullable|string|max:255',
            'harga' => 'required|numeric',
            'ticket_type_id' => 'required|exists:tikets,id',
        ]);

       
        Penumpang::create($request->all());

        return redirect()->route('penumpang.index')->with('success', 'Passenger created successfully.');
    }


    public function edit($id)
    {
        $penumpang = Penumpang::findOrFail($id);
        $tiket = Tiket::where('name', 'Penumpang')->get();
        return view('admin.penumpang.edit', compact('penumpang', 'tiket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'ticket_type_id' => 'required|exists:tikets,id',
        ]);

        $penumpang = Penumpang::findOrFail($id);
        $penumpang->update($request->all());

        return redirect()->route('penumpang.index')->with('success', 'Passenger updated successfully.');
    }

    public function destroy($id)
    {
        Penumpang::destroy($id);

        return redirect()->route('penumpang.index')->with('success', 'Passenger deleted successfully.');
    }
}
