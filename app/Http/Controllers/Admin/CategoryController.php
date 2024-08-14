<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data['category'] = Category::all();
        return view('admin.category.index', $data);
    }
    public function create()
    {
        $data['category'] = Category::all();
        return view('admin.category.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Category::create($request->all());
        return redirect()->route('category.index')->with('sucsses', 'berhasil menambah category');
    }
    public function edit($id)
    {
        $data['category'] = Category::find($id);
        return view('admin.category.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Category::findOrFail($id)->update($request->all());
        return redirect()->route('category.index')->with('sucsses', 'berhasil');
    }
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('category.index')->with('sucsses', 'berhasil');
    }
}
