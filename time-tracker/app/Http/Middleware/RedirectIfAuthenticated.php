<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    protected static $redirectToCallback;

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($this->redirectTo($request));
            }
        }

        return $next($request);
    }

    protected function redirectTo(Request $request): ?string
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        if ($user) {
            // Kiểm tra role của người dùng
            switch ($user->role) {
                case 'Admin':
                    return route('admin.dashboard');
                // case 'Manager':
                //     return route('manager.dashboard');
                default:
                    return route('dashboard');
            }
        }

        // Nếu không có người dùng hoặc không xác định được role, trả về URI mặc định
        return static::$redirectToCallback
            ? call_user_func(static::$redirectToCallback, $request)
            : $this->defaultRedirectUri();
    }

    protected function defaultRedirectUri(): string
    {
        foreach (['dashboard', 'home'] as $uri) {
            if (Route::has($uri)) {
                return route($uri);
            }
        }

        return '/';
    }

    public static function redirectUsing(callable $redirectToCallback)
    {
        static::$redirectToCallback = $redirectToCallback;
    }
}
