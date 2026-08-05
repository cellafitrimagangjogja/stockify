<?php

namespace App\Services\Services_admin;

use App\Models\Supplier;

class SupplierService
{
    public function getAll()
    {
        return Supplier::latest()->get();
    }

    public function find($id)
    {
        return Supplier::findOrFail($id);
    }

    public function create(array $data)
    {
        return Supplier::create([
            'name'    => $data['name'],
            'address' => $data['address'],
            'phone'   => $data['phone'],
            'email'   => $data['email'],
        ]);
    }

    public function update($id, array $data)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($data);

        return $supplier;
    }

    public function delete($id)
    {
        return Supplier::destroy($id);
    }
}