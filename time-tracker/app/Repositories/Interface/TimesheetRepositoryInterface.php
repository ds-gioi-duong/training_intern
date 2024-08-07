<?php
namespace App\Repositories\Interface;
use Inertia\Response;
use Inertia\Inertia;
interface TimesheetRepositoryInterface
{
    public function all($user_id);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function show($id);
    public function showTodayTimesheet($user_id);
}