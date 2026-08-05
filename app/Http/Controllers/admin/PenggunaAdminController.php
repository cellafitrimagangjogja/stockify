<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\Services_admin\PenggunaService;
use Illuminate\Validation\Rule;

class PenggunaAdminController extends Controller
{
    protected $penggunaService;

    public function __construct(PenggunaService $penggunaService)
    {
        $this->penggunaService = $penggunaService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->penggunaService->getAll();
        return view('example_admin.content.crud.admin.pengguna.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('example_admin.content.crud.admin.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:8',
            'role' => 'required'
        ]);
      

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

       

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = $this->penggunaService->find($id);

        return view('example_admin.content.crud.admin.pengguna.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        

        $request->validate([
           'name' => 'required|max:255',
            'email' =>  [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|min:8|max:8',
            'role' => 'required'
        ]);

        $this->penggunaService->update($id, $request->only([
            'name',
            'email',
            'password',
            'role'
        ]));

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $this->penggunaService->delete($id);

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'Kategori berhasil dihapus.');
    }
}
