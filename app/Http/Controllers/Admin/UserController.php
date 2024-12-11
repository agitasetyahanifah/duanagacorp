<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->dataTables();
        }

        return view('admin.user.index');
    }

    public function dataTables()
    {
        $data = User::where('role', 'user');

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($item) {
            $btnEdit = "<a href='".route('users.edit', ['user' => $item->id])."' title='Edit Data'
                class='btn btn-xs btn-warning'><i class='fas fa-edit'></i></a>";

            $btnDelete = "<button title='Hapus Data' data-url='".route('users.destroy', ['user' => $item->id])."'
                class='confirm_delete btn btn-xs btn-danger ml-1'><i class='fas fa-trash'></i></button>";

            return $btnEdit . $btnDelete;

            return '';
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);      

        try {
            DB::beginTransaction();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);            
            toast('Data berhasil di tambahkan','success');
            DB::commit();

            return redirect()->route('users.index');
        } catch (\Throwable $th) {

            toast('Gagal menambahkan data','error');
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        return view('admin.user.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_if:password,!=,null',
            'password' => 'nullable|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai.'])->withInput();
        }
    
        try {
            DB::beginTransaction();
    
            $user = User::findOrFail($id);
    
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
            ];
    
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }
    
            $user->update($updateData);
    
            toast('Data berhasil diubah', 'success');
            DB::commit();
    
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            toast('Gagal mengubah data', 'error');
            DB::rollBack();
            return redirect()->route('users.edit', ['user' => $id]);
        }
    }

    public function destroy(string $id)
    {
        $data = User::find($id);

        if($data->delete()){
            return ['status' => 'success', 'message' => 'Data berhasil di hapus'];
        }

        return ['status' => 'error', 'message' => 'Data berhasil gagal hapus'];
    }
}
