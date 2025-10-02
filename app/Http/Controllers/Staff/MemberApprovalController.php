<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberApprovalController extends Controller
{
    public function index()
    {
        $pendingMembers = User::where('role', 'member')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $allMembers = User::where('role', 'member')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('staff.member.index', compact('pendingMembers', 'allMembers'));
    }

    public function approve(User $user)
    {
        if ($user->role !== 'member') {
            return back()->with('error', 'สามารถอนุมัติเฉพาะ Member เท่านั้น');
        }

        $user->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'อนุมัติสมาชิกสำเร็จ');
    }

    public function reject(User $user)
    {
        if ($user->role !== 'member') {
            return back()->with('error', 'สามารถปฏิเสธเฉพาะ Member เท่านั้น');
        }

        $user->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'ปฏิเสธสมาชิกสำเร็จ');
    }

    public function edit(User $user)
    {
        if ($user->role !== 'member') {
            abort(403, 'คุณสามารถแก้ไขเฉพาะ Member เท่านั้น');
        }

        return view('staff.member.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'member') {
            abort(403, 'คุณสามารถแก้ไขเฉพาะ Member เท่านั้น');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('staff.members.index')->with('success', 'อัพเดทข้อมูล Member สำเร็จ');
    }
}
