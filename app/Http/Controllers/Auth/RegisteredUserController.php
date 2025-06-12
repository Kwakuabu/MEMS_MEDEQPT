<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department; // Ensure you include the Department model
use App\Models\Role; // Ensure you include the Role model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view with departments and roles.
     */
    public function create(): View
    {
        $departments = Department::all(); // Fetch all departments
        $roles = Role::all(); // Fetch all roles

        return view('auth.register', compact('departments', 'roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'department_id' => ['required', 'exists:departments,id'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
            'role_id' => $request->role_id,
        ]);
    
        event(new Registered($user));
        Auth::login($user);
    
        // Redirect based on role_id
        switch ($user->role_id) {
            case 1: // Assuming role_id 1 is Clinician
                return redirect()->route('clinician.dashboard');
            case 2: // Assuming role_id 2 is Technician
                return redirect()->route('technician.dashboard');
            case 3: // Assuming role_id 3 is Engineer
                return redirect()->route('engineer.dashboard');
            default:
                return redirect('/'); // Redirect to home or a default page if no specific role is found
        }
    }
    
    public function logout()
    {
        Auth::logout(); // Log the user out

        return redirect('/'); // Redirect to your desired page after logout
    }
}
