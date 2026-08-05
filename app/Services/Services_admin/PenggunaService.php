<?php

namespace App\Services\Services_admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
class PenggunaService
{
    public function getAll()
    {
        return User::latest()->get();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create([
            'name'    => $data['name'],
            'email' => $data['email'],
            'password'   => $data['password'],
            'role'   => $data['role'],
        ]);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
}