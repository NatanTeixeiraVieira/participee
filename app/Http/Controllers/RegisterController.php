<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {
    // Exibe o formulário de cadastro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Processa o cadastro do usuário
    public function register(Request $request)
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Formato de email inválido.',
            'email.unique' => 'Este email já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ]);

        // Cria o usuário com a senha criptografada
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Autentica o usuário após o cadastro (opcional)
        auth()->login($user);

        // Redireciona para a home ou dashboard com mensagem de sucesso
        return redirect()->route('/')->with('success', 'Cadastro realizado com sucesso! Bem-vindo, ' . $user->name);
    }
}
