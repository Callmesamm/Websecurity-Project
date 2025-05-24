<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();
            
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['بيانات الدخول غير صحيحة'],
                ]);
            }

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'roles' => $user->roles
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('خطأ في تسجيل الدخول: ' . $e->getMessage());
            return response()->json([
                'error' => 'حدث خطأ أثناء تسجيل الدخول'
            ], 500);
        }
    }

    public function users(Request $request)
    {
        try {
            if (!Auth::user()->hasRole('admin')) {
                return response()->json([
                    'error' => 'غير مصرح لك بالوصول إلى هذه البيانات'
                ], 403);
            }

            $users = User::select('id', 'first_name', 'last_name', 'email')
                ->with('roles')
                ->paginate(10);
                
            return response()->json([
                'users' => $users->items(),
                'pagination' => [
                    'total' => $users->total(),
                    'per_page' => $users->perPage(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage()
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('خطأ في جلب المستخدمين: ' . $e->getMessage());
            return response()->json([
                'error' => 'حدث خطأ أثناء جلب بيانات المستخدمين'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'تم تسجيل الخروج بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'حدث خطأ أثناء تسجيل الخروج'
            ], 500);
        }
    }
} 