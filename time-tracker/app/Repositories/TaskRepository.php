<?php
namespace App\Repositories;
use App\Models\Task;
use App\Repositories\Interface\TaskRepositoryInterface;
class TaskRepository implements TaskRepositoryInterface
{
    public function all()
    {
        return Task::all();
    }
    public function create(array $data)
    {
        return Task::create($data);
    }
    public function update(array $data, $id)
    {
        return Task::find($id)->update($data);
    }
    public function delete($id)
    {
        return Task::destroy($id);
    }
    public function show($id)
    {
        return Task::find($id);
    }
}