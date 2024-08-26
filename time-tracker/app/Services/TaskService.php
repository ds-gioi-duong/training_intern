<?php
namespace App\Services;
use App\Models\Task;
use App\Repositories\Interface\TaskRepositoryInterface;
class TaskService
{
    protected $taskRepository;
    function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    function store($request)
    {
        $this->taskRepository->create($request->all());
    }
    function destroy($task)
    {
        $this->taskRepository->delete($task->id);
    }
    function update($request, $task)
    {
        $this->taskRepository->update($request, $task->id);
    }
 
}

