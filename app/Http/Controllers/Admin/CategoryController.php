<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->dataTables();
        }

        return view('admin.category.index');
    }

    public function dataTables()
    {
        $data = Category::query();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($item) {
            if (Auth::user()->role == 'admin') {
                $btnEdit = "<a href='".route('categories.edit', ['category' => $item->id])."' title='Edit Data'
                    class='btn btn-xs btn-warning'><i class='fas fa-edit'></i></a>";

                $btnDelete = "<button title='Hapus Data' data-url='".route('categories.destroy', ['category' => $item->id])."'
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
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'regex:/^[a-z]+([A-Z][a-z]*)*$/',
            ],        
        ]);       

        try {
            DB::beginTransaction();

            Category::create([
                'name' => $request->name,
                'user_id' => Auth::id(),
            ]);            
            toast('Data berhasil di tambahkan','success');
            DB::commit();

            return redirect()->route('categories.index');
        } catch (\Throwable $th) {

            toast('Gagal menambahkan data','error');
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function edit(string $id)
    {
        $data = Category::findOrFail($id);

        return view('admin.category.edit',compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'regex:/^[a-z]+([A-Z][a-z]*)*$/',
            ],        
        ]);
    
        try {
            DB::beginTransaction();
    
            $category = Category::findOrFail($id);
    
            $category->update([
                'name' => $request->name,
                'user_id' => Auth::id(),
            ]);
    
            toast('Data berhasil diubah', 'success');
            DB::commit();
    
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            toast('Gagal mengubah data', 'error');
            DB::rollBack();
            return redirect()->route('categories.edit', ['category' => $id]);
        }
    }    

    public function destroy(string $id)
    {
        $data = Category::find($id);

        if($data->delete()){
            return ['status' => 'success', 'message' => 'Data berhasil di hapus'];
        }

        return ['status' => 'error', 'message' => 'Data berhasil gagal hapus'];
    }
}
