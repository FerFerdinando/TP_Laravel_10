<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the edit profile form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit()
    {
        return view('auth.edit', ['user' => Auth::user()]);
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'string', 'min:8', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'new_password' => ['nullable', 'string', 'min:8', 'regex:/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%^&*]{8,}$/', 'confirmed'],
        ], [
            'new_password.regex' => 'Password must contain at least one letter and one number.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('new_password')) {
            $updateData['password'] = Hash::make($request->new_password);
        }

        User::where('id', $user->id)->update($updateData);

        return redirect()->route('frog.index')->with('success', 'Profile updated successfully!');
    }
}
