<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\Auth\AuthResource;
use Illuminate\Http\Request;
use JWTAuth;
use Auth;
use Exception;
use Illuminate\Support\Facades\DB;

class AuthController extends ApiController
{
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->sendError400('Bad Request', 'Email hoặc mật khẩu không đúng.');
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Không thể tạo token, vui lòng thử lại sau.'], 500);
        }
        $user = Auth::user();
        $user = $user->setAttribute('token', $token);
        return $this->formatJson(AuthResource::class, $user);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->getData();
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $token = JWTAuth::fromUser($user);
            $user = $user->setAttribute('token', $token);
            DB::commit();
            return $this->formatJson(AuthResource::class, $user);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function me()
    {
        return $this->formatJson(AuthResource::class, auth('api')->user());
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->sendMessage('Đăng xuất thành công!');
    }
}
