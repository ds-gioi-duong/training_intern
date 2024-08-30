<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     */
    public function create(): Response
    {
        // dd( session('errors') ? session('errors')->getMessages() : []);
        return Inertia::render('User/Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
            'err' => session('errors') ? session('errors')->getMessages() : [],
        ]);
    }

    /**
     * Xử lý yêu cầu đăng nhập.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Xác thực người dùng
        $request->authenticate();

        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra role của người dùng
        if ($user && $user->role === 'User') {
            // Nếu role là "User", làm mới phiên và chuyển hướng đến trang dashboard
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard', absolute: false));
        } else {
            // Nếu role không phải "User", đăng xuất và chuyển hướng về trang đăng nhập với thông báo lỗi
            Auth::logout();
            return redirect()->route('login')->withErrors(['error' => 'Only users with the "User" role can log in.']);
        }
    }

    /**
     * Xóa phiên làm việc của người dùng đã đăng nhập.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
