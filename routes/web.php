<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Manager\StaffManagementController;
use App\Http\Controllers\Staff\MemberApprovalController;
use App\Http\Controllers\Member\ProfileController as MemberProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'approved'])->group(function () {
    
    Route::get('/dashboard', function () {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && $user->isAdmin()) {
            return redirect()->route('admin.users.index');
        } elseif ($user && $user->isManager()) {
            return redirect()->route('manager.staff.index');
        } elseif ($user && $user->isStaff()) {
            return redirect()->route('staff.members.index');
        } else {
            return redirect()->route('member.profile.index');
        }
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserManagementController::class);
    });

    // Manager Routes
    Route::middleware(['role:admin,manager'])->prefix('manager')->name('manager.')->group(function () {
        Route::resource('staff', StaffManagementController::class);
    });

    // Staff Routes
    Route::middleware(['role:admin,manager,staff'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('members', [MemberApprovalController::class, 'index'])->name('members.index');
        Route::post('members/{user}/approve', [MemberApprovalController::class, 'approve'])->name('members.approve');
        Route::post('members/{user}/reject', [MemberApprovalController::class, 'reject'])->name('members.reject');
        Route::get('members/{user}/edit', [MemberApprovalController::class, 'edit'])->name('members.edit');
        Route::put('members/{user}', [MemberApprovalController::class, 'update'])->name('members.update');
    });

    // Member Routes
    Route::prefix('member')->name('member.')->group(function () {
        Route::get('profile', [MemberProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [MemberProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [MemberProfileController::class, 'updatePassword'])->name('profile.password');
    });
});

require __DIR__.'/auth.php';
