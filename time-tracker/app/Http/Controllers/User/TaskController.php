<?php

namespace App\Http\Controllers\User;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    protected $taskService;
    // Laravel sẽ tự động xử lý việc tiêm các phụ thuộc vào constructor của controller, miễn là các phụ thuộc đó đã được đăng ký trong service container. Đây là cách Laravel tự động quản lý việc tiêm các phụ thuộc vào controller mà không cần bạn phải làm thêm điều gì trong phần cấu hình route.
    public function __construct(TaskService $taskRepository)
    {
        $this->taskService = $taskRepository;
    }
    public function store(StoreTaskRequest  $request) :RedirectResponse
    {
        $this->taskService->store($request->all());
        return redirect(route('timesheets.show', $request->timesheet_id));
    }
    public function destroy( Task $task):RedirectResponse
    {
        $this->taskService->destroy($task->id);
        return redirect(route('timesheets.show', $task->timesheet_id));
    }
    public function update( Task $task,UpdateTaskRequest  $request):RedirectResponse
    {
        Gate::authorize('update', $task);
        $this->taskService->update($request->all(), $task);
        return redirect(route('timesheets.show', $task->timesheet_id));

    }
    
}
