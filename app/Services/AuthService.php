<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Registrar un usuario en el sistema
     */
    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipo' => $data['tipo'],
        ]);

        return [
            'message' => 'Registro de usuario exitoso.',
            'user' => $user,
        ];
    }

    /**
     * Iniciar sesión en el sistema y se genera TOKEN
     */
    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (is_null($user) || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'access' => 'Las credenciales son incorrectas.'
            ]);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return [
            'message' => 'Inicio de sesion exitoso.',
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Cierre de sesión y eliminación de TOKENS
     */
    public function logout(User $user): array
    {
        $user->tokens()->delete();

        return ['message' => 'Cierre de sesión exitoso.'];
    }
}
