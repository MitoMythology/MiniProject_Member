<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StaffManagementController extends Controller
{
    public function index()
    {
        $staffs = User::where('role', 'staff')->orderBy('created_at', 'desc')->paginate(15);
        $allUsers = User::orderBy('created_at', 'desc')->paginate(15);
        return view('manager.staff.index', compact('staffs', 'allUsers'));
    }

    public function create()
    {
        return view('manager.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
            'status' => $request->status,
            'approved_at' => $request->status === 'approved' ? now() : null,
            'approved_by' => $request->status === 'approved' ? Auth::id() : null,
        ]);

        return redirect()->route('manager.staff.index')->with('success', 'สร้าง Staff สำเร็จ');
    }

    public function edit(User $user)
    {
        if ($user->role !== 'staff') {
            abort(403, 'คุณสามารถแก้ไขเฉพาะ Staff เท่านั้น');
        }

        return view('manager.staff.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'staff') {
            abort(403, 'คุณสามารถแก้ไขเฉพาะ Staff เท่านั้น');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
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
            $data['approved_by'] = Auth::id();
        }

        $user->update($data);

        return redirect()->route('manager.staff.index')->with('success', 'อัพเดท Staff สำเร็จ');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'staff') {
            abort(403, 'คุณสามารถลบเฉพาะ Staff เท่านั้น');
        }

        $user->delete();
        return redirect()->route('manager.staff.index')->with('success', 'ลบ Staff สำเร็จ');
    }
}