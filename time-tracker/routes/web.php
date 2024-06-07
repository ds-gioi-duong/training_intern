<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});


// Đoạn mã này sử dụng UserController từ namespace App\Http\Controllers để xử lý các yêu cầu được gửi đến route /users. Cụ thể:

// use App\Http\Controllers\UserController;: Đây là câu lệnh import (import statement) trong PHP. Nó cho phép sử dụng class UserController từ namespace App\Http\Controllers trong file hiện tại.

// Route::resource('users', UserController::class);: Đây là một route declaration trong Laravel. Nó tạo ra các route RESTful cho tài nguyên users, điều này tức là các route cho các hoạt động CRUD (Create, Read, Update, Delete) trên tài nguyên users. Cụ thể, nó tạo ra các route sau:

// GET /users: Hiển thị danh sách người dùng.
// GET /users/create: Hiển thị form để tạo mới người dùng.
// POST /users: Lưu thông tin của người dùng mới tạo.
// GET /users/{id}: Hiển thị thông tin của một người dùng cụ thể.
// GET /users/{id}/edit: Hiển thị form để chỉnh sửa thông tin của một người dùng.
// PUT/PATCH /users/{id}: Cập nhật thông tin của một người dùng.
// DELETE /users/{id}: Xóa một người dùng.
// Trong đó, UserController::class được sử dụng để xác định controller nào sẽ xử lý các yêu cầu được gửi đến các route này.
Route::resource('users', UserController::class);
    