<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $data['bank'] = Bank::all();
        return view('admin.bank.index', $data);
    }

    public function create()
    {
        $data['bank'] = Bank::all();
        return view('admin.bank.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rekening' => 'required',
        ]);

        Bank::create($request->all());
        return redirect()->route('bank.index');
    }

    public function edit($id)
    {
        $data['bank'] = Bank::find($id);
        return view('admin.bank.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'rekening' => 'required',
        ]);

        $bank = Bank::findOrFail($id);
        $bank->update($request->all());
        return redirect()->route('bank.index');
    }

    public function destroy($id)
    {
        Bank::find($id)->delete();
        return redirect()->route('bank.index');
    }
}

