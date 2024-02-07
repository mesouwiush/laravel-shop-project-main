<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request){

        //validation
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        ]);

        // Check if user already exists
        $existingUser = User::where('username', $request->username)->first();

        if ($existingUser) {
            return back()->withErrors(['username' => 'A user with this username already exists.']);
        }

        //store user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //sign the user in
        auth()->attempt($request->only('email', 'password'));


        //redirect
        return redirect()->route('dashboard');
    }
}

