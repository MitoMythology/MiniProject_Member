<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function index()
    {
        return view('member.profile.index');
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'อัพเดทโปรไฟล์สำเร็จ');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Re-fetch and ensure type for static analysis
        /** @var \App\Models\User|null $userForPassword */
        $userForPassword = Auth::user();
        if ($userForPassword) {
            $userForPassword->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return back()->with('success', 'เปลี่ยนรหัสผ่านสำเร็จ');
    }
}