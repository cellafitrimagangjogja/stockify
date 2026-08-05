<?php

namespace App\Repositories\ProductRepositories;

use LaravelEasyRepository\Repository;

interface ProductRepositoriesRepository extends Repository{

    public function getAll();

    public function findById($id);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}
