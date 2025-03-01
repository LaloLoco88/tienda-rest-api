<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(
        protected AuthService $authService
    ) {}

    /**
     * Registrar usuario
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $data = $this->authService->register($request->validated());

        return response()->json($data, 201);
    }

    /**
     * Iniciar sesión
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->validated());

        return response()->json($data);
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request): JsonResponse
    {
        $data = $this->authService->logout($request->user());

        return response()->json($data);
    }
}
