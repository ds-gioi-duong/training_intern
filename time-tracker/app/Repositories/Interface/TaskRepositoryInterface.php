<?php
namespace App\Repositories\Interface;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, $id);
    public function delete( $id);
    public function show($id);
}