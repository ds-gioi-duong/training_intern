<?php
namespace App\Http\Controllers\Admin;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        dd(session()->all());
        return Inertia::render('Admin/Dashboard');
    }
}