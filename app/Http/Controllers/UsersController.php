<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Payment;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $showAll = $request->input('show_all');

        if ($showAll) {
            $users = User::withTrashed()->get();
        } else {
            $users = User::all();
        }

        return view('users', ['users' => $users, 'showAll' => $showAll]);
    }

    public function create(Request $request)
    {
        $validation = $this->validateUser($request);
    
        $user = new User;
        $this->fillUserFromRequest($user, $request);
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect('/users')->with('success', 'Usuario creado exitosamente');
    }

    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        $user->payments()->withTrashed()->restore();

        return redirect('/users');
    }

    public function enableAccount(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect('/users');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users', ['user' => $user]);
    }

    public function update(Request $request, string $id)
    {
        $validation = $this->validateUser($request, $id);
    
        $user = User::findOrFail($id);
        $this->fillUserFromRequest($user, $request);
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect('/users')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->payments()->delete();

        $user->lections()->delete();
        $user->delete();

        return redirect('/users');
    }

    private function validateUser(Request $request, $id = null)
    {
        $validator = $request->validate([
            'name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => [
                'required',
                'email',
                'max:320',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'required|max:64',
        ]);
    
        return $validator;
    }    

    private function fillUserFromRequest(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
    }
}