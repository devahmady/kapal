<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
   public function index()
    {
        $tiket = Tiket::all();
        return view('admin.tiket.index', compact('tiket'));
    }

    public function create()
    {
        return view('admin.tiket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Tiket::create($request->all());

        return redirect()->route('tiket.index')->with('success', 'Ticket type created successfully.');
    }

    public function edit($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('admin.tiket.edit', compact('tiket$tiket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tiket = Tiket::findOrFail($id);
        $tiket->update($request->all());

        return redirect()->route('tiket.index')->with('success', 'Ticket type updated successfully.');
    }

    public function destroy($id)
    {
        Tiket::destroy($id);

        return redirect()->route('tiket.index')->with('success', 'Ticket type deleted successfully.');
    }
}
