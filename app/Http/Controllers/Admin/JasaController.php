<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PassengerType;
use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index()
    {
        $data['jasa'] = PassengerType::all();
        return view('admin.jasa.index', $data);
    }
    public function create()
    {
        $data['jasa'] = PassengerType::all();
        return view('admin.jasa.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);
        PassengerType::create($request->all());
        return redirect()->route('jasa.index')->with('sucsses', 'berhasil menambah jasa');
    }
    public function edit($id)
    {
        $data['jasa'] = PassengerType::find($id);
        return view('admin.jasa.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required'
        ]);
        PassengerType::findOrFail($id)->update($request->all());
        return redirect()->route('jasa.index')->with('sucsses', 'berhasil');
    }
    public function destroy($id)
    {
        PassengerType::destroy($id);
        return redirect()->route('jasa.index')->with('sucsses', 'berhasil');
    }
}
