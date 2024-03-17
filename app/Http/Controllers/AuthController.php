<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
//Todo lo realcionado con el login y el register

class AuthController extends Controller
{   

    public function logout()
    {
        Auth::logout();

        // Redirigir a la página de inicio de sesión u otra página
        return redirect('/');
    }

//Login
public function showLoginForm()
{
    return view('login');
}

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Authentication was successful
        return redirect()->route('home'); // Reemplaza 'home' con la ruta a tu vista home
    } else {
        // Autenticación fallida
        return redirect()->route('login')->with('error', 'Credenciales inválidas')->withInput();
    }
}

    //Register
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:10',
        ], [
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.max' => 'La contraseña no puede exceder los :max caracteres.',
            'email.unique' => 'El correo electrónico ya está asociado a una cuenta existente.',
        ]);
    
        $user = new User();
        $user->name = $validatedData['name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
    
        try {
            $user->save();
            return redirect()->route('register')->with('status', '¡Cuenta creada correctamente!');
        } catch (\Exception $e) {
            return redirect()->route('register')->withErrors(['email' => 'El correo electrónico ya está asociado a una cuenta existente.'])->withInput();
        }
    }
       
}
