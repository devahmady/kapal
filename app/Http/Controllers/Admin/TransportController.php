<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transportation;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function index()
    {
        $data['transport'] = Transportation::all();
        return view('admin.transport.index', $data);
    }

    public function create()
    {
        $data['transport'] = Transportation::all();
        return view('admin.transport.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);
        Transportation::create($request->all());
        return redirect()->route('transport.index')->with('success', 'Transportation Added Successfully');
    }
    public function edit($id)
    {
        $data['transport'] = Transportation::find($id);
        return view('admin.transport.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
        ]);
        $transportation = Transportation::findOrFail($id);
        $transportation->update($request->all());
        return redirect()->route('transport.index')->with('success', 'Transportation Updated Successfully');
    }
    public function destroy($id)
    {
        Transportation::find($id)->delete();
        return redirect()->route('transport.index')->with('success', 'Transportation Deleted Successfully');
    }
}
