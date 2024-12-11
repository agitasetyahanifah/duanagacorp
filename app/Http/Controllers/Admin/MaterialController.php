<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->dataTables();
        }

        return view('admin.material.index');
    }

    public function dataTables()
    {
        $data = Material::query();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('category_name', function($item) {
            return $item->category->name;
        })
        ->addColumn('price', function($item) {
            return 'Rp ' . number_format($item->price, 0, ',', '.');
        })
        ->addColumn('action', function($item) {
            if (Auth::user()->role == 'admin') {
                $btnEdit = "<a href='".route('materials.edit', ['material' => $item->id])."' title='Edit Data'
                    class='btn btn-xs btn-warning'><i class='fas fa-edit'></i></a>";

                $btnDelete = "<button title='Hapus Data' data-url='".route('materials.destroy', ['material' => $item->id])."'
                    class='confirm_delete btn btn-xs btn-danger ml-1'><i class='fas fa-trash'></i></button>";

                return $btnEdit . $btnDelete;
            }

            return '';
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.material.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-z]+([A-Z][a-z]*)*$/',
            ], 
            'price' => 'required',
            'stock' => 'required|integer',
            'date_input' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $price = str_replace([',', '.'], '', $request->price);
    
        try {
            DB::beginTransaction();
    
            Material::create([
                'name' => $request->name,
                'price' => $price,
                'stock' => $request->stock,
                'date_input' => $request->date_input,
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
            ]);
    
            toast('Data berhasil disimpan', 'success');
            DB::commit();
            return redirect()->route('materials.index');
        } catch (\Throwable $th) {
            toast('Gagal menyimpan data', 'error');
            DB::rollBack();
            return redirect()->route('materials.create');
        }
    }

    public function edit(string $id)
    {
        $data = Material::findOrFail($id);
        $categories = Category::all();

        return view('admin.material.edit',compact('data', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-z]+([A-Z][a-z]*)*$/',
            ], 
            'price' => 'required',
            'stock' => 'required|integer',
            'date_input' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        $price = str_replace([',', '.'], '', $request->price);
    
        try {
            DB::beginTransaction();
    
            $material = Material::findOrFail($id);
            $material->update([
                'name' => $request->name,
                'price' => $price,
                'stock' => $request->stock,
                'date_input' => $request->date_input,
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
            ]);
    
            toast('Data berhasil diperbarui', 'success');
            DB::commit();
            return redirect()->route('materials.index');
        } catch (\Throwable $th) {
            toast('Gagal memperbarui data', 'error');
            DB::rollBack();
            return redirect()->route('materials.edit', ['material' => $id]);
        }
    }    

    public function destroy(string $id)
    {
        $data = Material::find($id);

        if($data->delete()){
            return ['status' => 'success', 'message' => 'Data berhasil di hapus'];
        }

        return ['status' => 'error', 'message' => 'Data berhasil gagal hapus'];
    }
}
