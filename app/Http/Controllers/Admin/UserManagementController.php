<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,manager,staff,member'],
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
            'approved_at' => $request->status === 'approved' ? now() : null,
            'approved_by' => $request->status === 'approved' ? optional(Auth::user())->id : null,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'สร้างผู้ใช้สำเร็จ');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,manager,staff,member'],
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', Rules\Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }

        if ($request->status === 'approved' && $user->status !== 'approved') {
            $data['approved_at'] = now();
            $data['approved_by'] = optional(Auth::user())->id;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'อัพเดทผู้ใช้สำเร็จ');
    }

    public function destroy(User $user)
    {
        if ($user->id === optional(Auth::user())->id) {
            return back()->with('error', 'คุณไม่สามารถลบบัญชีตัวเองได้');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'ลบผู้ใช้สำเร็จ');
    }
}
