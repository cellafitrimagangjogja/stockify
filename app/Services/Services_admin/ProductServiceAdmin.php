<?php

namespace App\Services\Product;

interface ProductServiceAdmin
{
    public function getAll();

    public function findById($id);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}