<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Timesheet;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Repositories\Interface\TaskRepositoryInterface;

class TaskController extends Controller
{
    protected $taskRepository;
    // Laravel sẽ tự động xử lý việc tiêm các phụ thuộc vào constructor của controller, miễn là các phụ thuộc đó đã được đăng ký trong service container. Đây là cách Laravel tự động quản lý việc tiêm các phụ thuộc vào controller mà không cần bạn phải làm thêm điều gì trong phần cấu hình route.
     
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    public function store(Timesheet $timesheet,StoreTaskRequest  $request) :RedirectResponse
    {
        $this->taskRepository->create($request->all());
        return redirect(route('timesheets.show', $timesheet->id));
    }
    public function destroy( Task $task):RedirectResponse
    {
        $this->taskRepository->delete($task->id);
        return redirect(route('timesheets.show', $task->timesheet_id));
    }
    public function update( Task $task,StoreTaskRequest  $request):RedirectResponse
    {
        $this->taskRepository->update($request->all(), $task->id);
        return redirect(route('timesheets.show', $task->timesheet_id));
    }
    
}
