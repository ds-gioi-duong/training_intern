<?php
namespace App\Http\Controllers\Admin;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard');
    }
    public function messages()
    {
        return Inertia::render('Admin/Messages');
    }
    public function settings()
    {
        return Inertia::render('Admin/Settings');
    }
    public function user_manager()
    {
        
        return Inertia::render('Admin/UserManager');
    }

}